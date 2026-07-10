<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Recipes;

class PlanningController extends Controller
{
    function index()
    {
      // one day  in seconds = 86400
      // one week in seconds = 604800

        $planning = Planning::where('user_id', Auth::id())->get();
        $recipes = Recipes::where('user_id', Auth::id())->get();
        $ingredients = $ingredients = Auth::user()
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
        $planning = $this->getWeekPlannings();

        return view('planning', compact('planning', 'recipes', 'ingredients'));
    }

    function edit($weekTitle) {
        $planning = $this->getWeekPlannings();
        $recipes = Recipes::where('user_id', Auth::id())->get();
        foreach($planning as $week) {
            if ($week['weekTitle'] == $weekTitle) {
                $planning = $week;
            }
        }

        return view('planning.edit', compact('planning', 'recipes'));
    }

    function patch(Request $request) {
        foreach($request->days as $date => $recipeId) {
            if (empty($recipeId)) {
                Planning::where('user_id', Auth::id())->where('planned_date', $date)->delete();
                continue;
            }
            Planning::updateOrCreate([
                'user_id' => Auth::id(),
                'planned_date' => $date
            ], [
                'recipe_id' => $recipeId
            ]);
        }
        return redirect()->route('planning');
    }
}
