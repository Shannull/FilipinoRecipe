<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RecipeController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $recipes = auth()->user()->recipes()->distinct()->get(); // Fetch unique recipes for the authenticated user
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'introductions' => 'required|string',
            'ingredients' => 'required|string',
            'directions' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|array',
            'category.*' => 'in:Rice,Soup and Stews,Pulutan,Fiesta Food,Sweets',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $data['category'] = implode(',', $request->category);

        auth()->user()->recipes()->create($data);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        $this->authorize('view', $recipe); // Ensure the user is authorized to view the recipe
        $recipe->load('comments.user'); // Load comments with user relationship
        session(['previous_url' => url()->previous()]); // Store the previous URL in the session
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe); // Ensure the user is authorized to edit the recipe
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe); // Ensure the user is authorized to update the recipe

        $request->validate([
            'title' => 'required|string|max:255',
            'introductions' => 'required|string',
            'ingredients' => 'required|string',
            'directions' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|array',
            'category.*' => 'in:Rice,Soup and Stews,Pulutan,Fiesta Food,Sweets',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $data['category'] = implode(',', $request->category);

        $recipe->update($data);

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe); // Ensure the user is authorized to delete the recipe
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }
}