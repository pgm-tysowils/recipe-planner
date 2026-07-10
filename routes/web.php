<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageControllers\HomeController;
use App\Http\Controllers\PageControllers\RecipesController;
use App\Http\Controllers\PageControllers\IngredientsController;
use App\Http\Controllers\PageControllers\PlanningController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/recipes', [RecipesController::class, 'index'])->name('recipes');
Route::get('/recipes/create', [RecipesController::class, 'create'])->name('recipe.create');
Route::get('/recipes/{id}', [RecipesController::class, 'detail'])->name('recipe');
Route::post('/recipes/create', [RecipesController::class, 'store'])->name('recipe.store');

Route::get('/ingredients', [IngredientsController::class, 'index'])->name('ingredients');
Route::get('/planning', [PlanningController::class, 'index'])->name('planning');

Route::view('/about', 'about')->name('about');

//middleware for auth and verified users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/recipes', [RecipesController::class, 'index'])->name('recipes');
    Route::get('/recipes/create', [RecipesController::class, 'create'])->name('recipe.create');
    Route::get('/recipes/{id}/edit', [RecipesController::class, 'edit'])->name('recipes.edit');
    Route::get('/recipes/{id}', [RecipesController::class, 'detail'])->name('recipe');
    Route::post('/recipes/create', [RecipesController::class, 'store'])->name('recipe.store');
    Route::post('/recipes/{id}', [RecipesController::class, 'patch'])->name('recipe.update');

    Route::get('/ingredients', [IngredientsController::class, 'index'])->name('ingredients');
    Route::get('/ingredients/create', [IngredientsController::class, 'create'])->name('ingredients.create');
    Route::post('/ingredients/store', [IngredientsController::class, 'store'])->name('ingredients.store');

    Route::get('/planning', [PlanningController::class, 'index'])->name('planning');
    Route::get('/planning/edit/{weekTitle}', [PlanningController::class, 'edit'])->name('planning.edit');
    Route::post('/planning/edit/{weekTitle}', [PlanningController::class, 'patch'])->name('planning.patch');
});

require __DIR__.'/settings.php';
