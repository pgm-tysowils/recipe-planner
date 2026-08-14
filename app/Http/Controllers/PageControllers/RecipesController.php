<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Recipes;
use App\Models\Ingredients;

class RecipesController extends Controller
{
    function index(Request $request) {
        $canCreate = $request->query('ready');
        $recipes = Auth::user()->recipes()->get();
        if ($canCreate) {
            $recipes = $this->createableRecipes($recipes);
        }
        return view('recipes', ['recipes' => $recipes]);
    }

    function detail($id) {
        // fetch the recipe
        $recipe = Auth::user()->recipes()->findOrFail($id);

        // split the string into an array of steps based on the pattern ", 1. "
        $steps = preg_split('/\d+\.\s/', $recipe['steps']);
        array_shift($steps); 
        $recipe['steps'] = $steps;

        // show the recipe detail view
        return view('recipes.detail', ['recipe' => $recipe]);
    }

    function create() {
        $ingredients = Ingredients::orderBy('name')->get();
        return view('recipes.create', ['ingredients' => $ingredients]);
    }

    function store(Request $request) {
        print_r($request->all());
        $recipe = Recipes::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'total_time' => $request->total_time,
            'servings' => $request->serving_size,
            'steps' => $request->steps,
        ]);

        $pivotData = [];
        foreach ($request->ingredients as $ingredient) {
            $pivotData[$ingredient['ingredient_id']] = ['weight' => $ingredient['amount']];
        };

        $recipe->ingredients()->attach($pivotData);

        return redirect()->route('recipes');
    }

    function edit($id) {
        $recipe = Auth::user()->recipes()->with('ingredients')->findOrFail($id);
        $allIngredients = Ingredients::orderBy('name')->get();
        return view('recipes.edit', ['recipe' => $recipe, 'allIngredients' => $allIngredients]);
    }

    function patch($id, Request $request) {
        $recipe = Auth::user()->recipes()->findOrFail($id);
        $recipe->update([
            'name' => $request->name,
            'image_url' => $request->image_url,
            'description' => $request->description,
            'total_time' => $request->total_time,
            'servings' => $request->serving_size,
            'steps' => $request->steps,
        ]);

        $recipe->ingredients()->detach();
        $pivotData = [];
        foreach ($request->ingredients as $ingredient) {
            $pivotData[$ingredient['ingredient_id']] = ['weight' => $ingredient['amount']];
        };
        $recipe->ingredients()->attach($pivotData);

        return redirect()->route('recipes');
    }
}