<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Recipes;
use App\Models\Planning;

abstract class Controller
{
    function getMondays() {
        $dateMonday;
        $today = date("l");

        if ($today == "Monday") {
          $dateMonday = strtotime($today);
        } else {
          $dateMonday = strtotime("Monday") - 604800;
        }

        $mondays = [$dateMonday];
        $nextMonday;
        for ($i=1; $i < 4; $i++) { 
          $multiplier = 604800 * $i;
          $nextMonday = $dateMonday + $multiplier;
          $mondays[] = $nextMonday;
        };

        return $mondays;
    }

    function getWeekPlannings() {
        $recipes = Recipes::where('user_id', Auth::id())->get();
        $planning = Planning::where('user_id', Auth::id())->get()->toArray();
        $ingredients = $ingredients = Auth::user()
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

      //make an array where everything is in that is needed for the week planning so i don't need to calculate and check it in the blade
        $newPlanning; // it will have the following structure ['week'=>'day']
        $weekDays = []; // this will save the days and their data
        $missingIngredients = []; //this will save all the ingredients the user misses for the entire week
        $neededIngredients = []; // this will save all the ingredients needed for a week
        $mondays = $this->getMondays();
        foreach($mondays as $monday) {
            $weekTitle;
            if ($monday < time()) {
                $weekTitle = 'Deze week';
            } else {
                $weekTitle = 'week van '. date('d M', $monday);
            }

            for ($i = 0; $i < 7; $i++) {
                $dayTitle = date('l d M', $monday + (86400 * $i));
                $currentDay = date('l d M',$monday + (86400 * $i));
                $todaysMeal = '';
                $todaysMealId = '';
                foreach ($planning as $plan) {
                    if ($currentDay == $plan['planned_date']) {
                        $cRecipe = $recipes[$plan['recipe_id'] -1];
                        $todaysMeal = $cRecipe['name'];
                        $todaysMealId = $cRecipe['id'];

                        $rIngredients = $cRecipe->ingredients()->withPivot('weight')->get()->map(function ($ingredient) {
                            return [
                                'id' => $ingredient->id,
                                'name' => $ingredient->name,
                                'weight' => $ingredient->pivot->weight,
                                'unit' => $ingredient->unit,
                            ];
                        });
                        foreach ($rIngredients as $ingredient) {
                            $alreadySaved = false;
                            $index = 0;
                            foreach ($neededIngredients as $needed) {
                                if ($needed['id'] == $ingredient['id']) {
                                    $alreadySaved = true;
                                    $neededIngredients[$index]['weight'] += $ingredient['weight'];
                                    break;
                                }
                                $index++;
                            }
                            if ($alreadySaved == false) {
                                $neededIngredients[] = $ingredient;
                            }
                        }
                    }
                }

                $weekDays[] = [
                    'dayTitle' => $dayTitle,
                    'recipe' => $todaysMeal,
                    'recipe_id' => $todaysMealId
                ];
                $dayTitle = '';
                $todaysMeal = '';
                $todaysMealId = '';
            }

            //calculate the missing ingredients
            foreach ($neededIngredients as $needed) {
                $checkThisIngredient = [];
                foreach ($ingredients as $ingredient) {
                    if ($needed['id'] == $ingredient['id']) {
                        $checkThisIngredient = $ingredient;
                    }
                }
                if (!empty($checkThisIngredient)) {
                    if ($needed['weight'] > $checkThisIngredient['weight']) {
                        $calculatedWeight = $needed['weight'] - $checkThisIngredient['weight'];
                        $missingIngredients[] = [
                            'id' => $needed['id'],
                            'name' => $needed['name'],
                            'weight' => $calculatedWeight,
                            'unit' => $needed['unit']
                        ];
                    }
                }       
            }

            $newPlanning[] = [
                    'weekTitle' => $weekTitle,
                    'days' => $weekDays,
                    'missingIngredients' => $missingIngredients
            ];
            $weekTitle = '';
            $weekDays = [];
            $missingIngredients = [];
            $neededIngredients = [];
        }
        return $newPlanning;
    }

    function createableRecipes($recipes) {
        $craftable = [];
        $ingredients = Auth::user()->ingredients()->get();

        foreach ($recipes as $recipe) {
        
            $canMake = true;
        
            foreach ($recipe->ingredients as $ingredient) {
        
                $required = $ingredient->pivot->weight;
                $available = $ingredients[$ingredient->id] ?? 0;
        
                if ($available < $required) {
                    $canMake = false;
                    break;
                }
            }
        
            if ($canMake) {
                $craftable[] = $recipe;
            }
        }
        return $craftable;
    }
}
