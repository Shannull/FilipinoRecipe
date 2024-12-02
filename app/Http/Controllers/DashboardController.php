<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('introductions', 'like', '%' . $request->search . '%')
                  ->orWhere('ingredients', 'like', '%' . $request->search . '%')
                  ->orWhere('directions', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->category != 'All') {
            $query->where('category', $request->category);
        }

        $recipes = $query->get()->groupBy('category');

        return view('dashboard', compact('recipes'));
    }
}