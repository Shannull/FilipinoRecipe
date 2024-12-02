<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Recipe;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $like = Like::firstOrCreate([
            'user_id' => auth()->id(),
            'recipe_id' => $recipe->id,
        ]);

        return back();
    }

    public function destroy(Recipe $recipe)
    {
        $like = Like::where('user_id', auth()->id())->where('recipe_id', $recipe->id)->first();
        if ($like) {
            $like->delete();
        }

        return back();
    }
}