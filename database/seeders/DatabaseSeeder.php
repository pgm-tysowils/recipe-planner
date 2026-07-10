<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipes;
use App\Models\Ingredients;
use App\Models\Planning;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'tester@example.com',
                'password' => bcrypt('test123'),
            ],
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }

        $ingredients = [
            [
                'name' => 'Spaghetti',
                'unit' => 'grams',
            ],
            [
                'name' => 'Chicken',
                'unit' => 'grams',
            ],
            [
                'name' => 'Beef',
                'unit' => 'grams',
            ],
            [
                'name' => 'paprika',
                'unit' => 'grams',
            ],
            [
                'name' => 'onion',
                'unit' => 'grams',
            ],
            [
                'name' => 'garlic',
                'unit' => 'grams',
            ],
            [
                'name' => 'tomato sauce',
                'unit' => 'grams',
            ],
            [
                'name' => 'soy sauce',
                'unit' => 'grams',
            ],
            [
                'name' => 'curry powder',
                'unit' => 'grams',
            ],
            [
                'name' => 'taco shells',
                'unit' => 'pieces',
            ],
            [
                'name' => 'lettuce',
                'unit' => 'grams',
            ],
            [
                'name' => 'cheese',
                'unit' => 'grams',
            ],
            [
                'name' => 'sour cream',
                'unit' => 'grams',
            ],
            [
                'name' => 'cilantro',
                'unit' => 'grams',
            ],
            [
                'name' => 'lime',
                'unit' => 'pieces',
            ],
            [
                'name' => 'avocado',
                'unit' => 'pieces',
            ],
            [
                'name' => 'black beans',
                'unit' => 'grams',
            ],
            [
                'name' => 'corn kernels',
                'unit' => 'grams',
            ],
            [
                'name' => 'bell peppers',
                'unit' => 'grams',
            ],
            [
                'name' => 'broccoli',
                'unit' => 'grams',
            ],
            [
                'name' => 'carrots',
                'unit' => 'grams',
            ],
            [
                'name' => 'coconut milk',
                'unit' => 'milliliters',
            ],
            [
                'name' => 'rice',
                'unit' => 'grams',
            ],
            [
                'name' => 'noodles',
                'unit' => 'grams',
            ]
        ];

        foreach ($ingredients as $ingredient) {
            Ingredients::create($ingredient);
        }

        // get the first customer
        $customer = User::skip(1)->first();

        $recipes = [
            [
                'user_id' => $customer->id,
                'name' => 'Spaghetti Bolognese',
                'description' => 'A classic Italian pasta dish with rich meat sauce.',
                'image_url' => 'https://example.com/spaghetti.jpg',
                'total_time' => 45,
                'servings' => 4,
                'steps' => '1. Brown the ground beef. 2. Add onions and garlic. 3. Pour in tomato sauce. 4. Simmer for 20 minutes. 5. Cook pasta. 6. Combine and serve.',
                'ingredients' => [
                    ['name' => 'Spaghetti', 'quantity' => 400, 'unit' => 'grams'],
                    ['name' => 'Ground Beef', 'quantity' => 500, 'unit' => 'grams'],
                    ['name' => 'Onion', 'quantity' => 1, 'unit' => 'piece'],
                    ['name' => 'Garlic', 'quantity' => 2, 'unit' => 'cloves'],
                    ['name' => 'Tomato Sauce', 'quantity' => 800, 'unit' => 'grams'],
                ],
            ],
            [
                'user_id' => $customer->id,
                'name' => 'Chicken Curry',
                'description' => 'A flavorful and spicy chicken curry with a creamy sauce.',
                'image_url' => 'https://example.com/chicken_curry.jpg',
                'total_time' => 60,
                'servings' => 4,
                'steps' => '1. Sauté onions and garlic. 2. Add curry powder and cook. 3. Add chicken pieces. 4. Add coconut milk. 5. Simmer for 30 minutes. 6. Serve with rice.',
                'ingredients' => [
                    ['name' => 'Chicken', 'quantity' => 500, 'unit' => 'grams'],
                    ['name' => 'Onion', 'quantity' => 1, 'unit' => 'piece'],
                    ['name' => 'Garlic', 'quantity' => 2, 'unit' => 'cloves'],
                    ['name' => 'Curry Powder', 'quantity' => 2, 'unit' => 'tablespoons'],
                    ['name' => 'Coconut Milk', 'quantity' => 400, 'unit' => 'milliliters'],
                ],
            ],
            [
                'user_id' => $customer->id,
                'name' => 'Beef Tacos',
                'description' => 'Delicious beef tacos with fresh toppings.',
                'image_url' => 'https://example.com/beef_tacos.jpg',
                'total_time' => 30,
                'servings' => 4,
                'steps' => '1. Cook ground beef with taco seasoning. 2. Prepare taco shells. 3. Assemble tacos with beef, lettuce, cheese, and salsa. 4. Serve immediately.',
                'ingredients' => [
                    ['name' => 'Ground Beef', 'quantity' => 500, 'unit' => 'grams'],
                    ['name' => 'Taco Shells', 'quantity' => 8, 'unit' => 'pieces'],
                    ['name' => 'Lettuce', 'quantity' => 100, 'unit' => 'grams'],
                    ['name' => 'Cheese', 'quantity' => 100, 'unit' => 'grams'],
                    ['name' => 'Salsa', 'quantity' => 150, 'unit' => 'grams'],
                ],
            ],
            [
                'user_id' => $customer->id,
                'name' => 'Vegetable Stir Fry',
                'description' => 'A quick and healthy vegetable stir fry with soy sauce.',
                'image_url' => 'https://example.com/vegetable_stir_fry.jpg',
                'total_time' => 20,
                'servings' => 2,
                'steps' => '1. Heat oil in a pan. 2. Add chopped vegetables. 3. Stir fry for 5-7 minutes. 4. Add soy sauce and cook for another 2 minutes. 5. Serve hot with rice or noodles.',
                'ingredients' => [
                    ['name' => 'Broccoli', 'quantity' => 200, 'unit' => 'grams'],
                    ['name' => 'Carrots', 'quantity' => 100, 'unit' => 'grams'],
                    ['name' => 'Bell Peppers', 'quantity' => 100, 'unit' => 'grams'],
                    ['name' => 'Soy Sauce', 'quantity' => 2, 'unit' => 'tablespoons'],
                    ['name' => 'Garlic', 'quantity' => 2, 'unit' => 'cloves'],
                ],
            ],
        ];

        foreach ($recipes as $recipeData) {
            $ingredientsData = $recipeData['ingredients'];
            unset($recipeData['ingredients']);

            $recipe = Recipes::create($recipeData);

            foreach ($ingredientsData as $ingredientData) {
                $ingredientId = Ingredients::where('name', $ingredientData['name'])->value('id');

                $recipe->ingredients()->attach($ingredientId, ['weight' => $ingredientData['quantity']]);
            }
        }

        // get the recipes from the first customer 
        $recipes = Recipes::where('user_id', $customer->id)->get();

        $userIngredients = [
            ['name' => 'Spaghetti', 'quantity' => 400, 'unit' => 'grams'],
            ['name' => 'Ground Beef', 'quantity' => 500, 'unit' => 'grams'],
            ['name' => 'Onion', 'quantity' => 1, 'unit' => 'piece'],
            ['name' => 'Garlic', 'quantity' => 2, 'unit' => 'cloves'],
            ['name' => 'Tomato Sauce', 'quantity' => 800, 'unit' => 'grams'],
            ['name' => 'Chicken', 'quantity' => 500, 'unit' => 'grams'],
            ['name' => 'Curry Powder', 'quantity' => 2, 'unit' => 'tablespoons'],
            ['name' => 'Coconut Milk', 'quantity' => 400, 'unit' => 'milliliters'],
            ['name' => 'Taco Shells', 'quantity' => 8, 'unit' => 'pieces'],
            ['name' => 'Lettuce', 'quantity' => 100, 'unit' => 'grams'],
            ['name' => 'Cheese', 'quantity' => 100, 'unit' => 'grams'],
            ['name' => 'Salsa', 'quantity' => 150, 'unit' => 'grams'],
            ['name' => 'Broccoli', 'quantity' => 200, 'unit' => 'grams'],
            ['name' => 'Carrots', 'quantity' => 100, 'unit' => 'grams'],
            ['name' => 'Bell Peppers', 'quantity' => 100, 'unit' => 'grams'],
        ];

        foreach ($userIngredients as $ingredientData) {
            $ingredientId = Ingredients::where('name', $ingredientData['name'])->value('id');

            $customer->ingredients()->attach($ingredientId, ['weight' => $ingredientData['quantity']]);
        }

        Planning::create([
            'user_id' => $customer->id,
            'recipe_id' => $recipes->first()->id,
            'planned_date' => 'Tuesday 07 Jul',
        ]);

        Planning::create([
            'user_id' => $customer->id,
            'recipe_id' => $recipes->skip(1)->first()->id,
            'planned_date' => 'Wednesday 08 Jul',
        ]);

        Planning::create([
            'user_id' => $customer->id,
            'recipe_id' => $recipes->skip(2)->first()->id,
            'planned_date' => 'Friday 10 Jul',
        ]);

        Planning::create([
            'user_id' => $customer->id,
            'recipe_id' => $recipes->skip(3)->first()->id,
            'planned_date' => 'Monday 06 Jul',
        ]);
    }
}
