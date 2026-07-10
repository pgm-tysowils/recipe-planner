<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ingredients;
use App\Models\User;

class IngredientsController extends Controller
{
    function index()
    {
        $ingredients = Auth::user()
            ->ingredients()
            ->withPivot('weight')
            ->get()
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'weight' => $ingredient->pivot->weight,
                    'unit' => $ingredient->unit,
                ];
            });

        return view('ingredients', compact('ingredients'));
    }

    function create()
    {
        $userStock = Auth::user()
            ->ingredients()
            ->get()
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'unit' => $ingredient->unit,
                    'weight' => $ingredient->pivot->weight,
                ];
            });

        $allIngredients = Ingredients::orderBy('name')->get();

        $ingredients = $allIngredients->map(function ($ingredient) use ($userStock) {
            return [
                'id' => $ingredient->id,
                'name' => $ingredient->name,
                'unit' => $ingredient->unit,
                'weight' => $userStock[$ingredient->id] ?? 0,
                'has_stock' => isset($userStock[$ingredient->id]),
            ];
        });

        return view('ingredients.create', compact('userStock', 'ingredients', 'allIngredients'));
    }

    function store(Request $request)
    {
        $user = Auth::user();
        $ingredients = $request->input('stock', []);

        // Detach all existing ingredients
        $user->ingredients()->detach();

        // Attach new ingredients with weights
        foreach ($ingredients as $ingredient) {
            if (isset($ingredient['ingredient_id']) && isset($ingredient['amount'])) {
                $user->ingredients()->attach($ingredient['ingredient_id'], ['weight' => $ingredient['amount']]);
            }
        }

        return redirect()->route('ingredients')->with('success', 'Stock updated successfully.');
    }
}
