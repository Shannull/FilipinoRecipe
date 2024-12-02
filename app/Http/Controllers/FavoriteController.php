<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())->with('recipe')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request, Recipe $recipe)
    {
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'recipe_id' => $recipe->id,
        ]);

        return back();
    }

    public function destroy(Recipe $recipe)
    {
        $favorite = Favorite::where('user_id', auth()->id())->where('recipe_id', $recipe->id)->first();
        if ($favorite) {
            $favorite->delete();
        }

        return back();
    }
}