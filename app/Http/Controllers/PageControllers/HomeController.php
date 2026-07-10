<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipes;
use App\Models\Ingredients;
use App\Models\User;
use App\Models\Planning;

class HomeController extends Controller
{
    function index()
    {
        $recipes = Recipes::where('user_id', Auth::id())->get();
        $planning = Planning::where('user_id', Auth::id())->get();
        $ingredients = Auth::user()
            ->ingredients()
            ->withPivot('weight')
            ->paginate(25)
            ->map(function ($ingredient) {
                return [
                    'id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'weight' => $ingredient->pivot->weight,
                    'unit' => $ingredient->unit,
                ];
            });
        $newPlanning = $this->getWeekPlannings($recipes, $ingredients, $planning);
        $craftable = $this->createableRecipes($recipes);

        // Limit the number of recipes displayed to 3
        if (count($craftable) > 3) {
            $craftable = array_slice($craftable, 0, 3);
        }

        $newPlanning = $newPlanning[0];
        $recipes = $craftable;
        return view('home', compact('recipes', 'ingredients', 'newPlanning'));
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
