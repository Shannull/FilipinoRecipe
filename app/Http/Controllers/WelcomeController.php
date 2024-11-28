<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('introductions', 'like', '%' . $request->search . '%')
                  ->orWhere('ingredients', 'like', '%' . $request->search . '%')
                  ->orWhere('directions', 'like', '%' . $request->search . '%');
        }

        $recipes = $query->get();

        return view('components.welcome', compact('recipes'));
    }
}