<?php

namespace Database\Seeders;

use App\Models\Drink;
use App\Models\DrinkIngredient;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private $drinks = [
        [
            'name' => 'Old Fashioned',
            'ingredients' => [
                ['name' => 'Bourbon', 'measurement' => ['oz' => '1.5oz', 'ml' => '45ml']],
                ['name' => 'Simple Syrup', 'measurement' => '0.5oz'],
                ['name' => 'Angostura Bitters', 'measurement' => '2 dashes'],
                ['name' => 'Orange slice'],
                ['name' => 'Maraschino cherry']
            ]
        ],
        [
            'name' => 'Martini',
            'ingredients' => [
                ['name' => 'Gin', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']],
                ['name' => 'Dry Vermouth', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']],
                ['name' => 'Orange Bitters', 'measurement' => '1 dash'],
                ['name' => 'Lemon Twist']
            ]
        ],
        [
            'name' => 'Manhattan',
            'ingredients' => [
                ['name' => 'Bourbon', 'measurement' => ['oz' => '2oz', 'ml' => '60ml']],
                ['name' => 'Sweet Vermouth', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']],
                ['name' => 'Angostura Bitters', 'measurement' => '2 dashes'],
                ['name' => 'Maraschino cherry']
            ]
        ],
        [
            'name' => 'Negroni',
            'ingredients' => [
                ['name' => 'Gin', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']],
                ['name' => 'Campari', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']],
                ['name' => 'Sweet Vermouth', 'measurement' => ['ml' => '30ml', 'oz' => '1oz']]
            ]
        ],
        [
            'name' => 'Espresso Martini',
            'ingredients' => [
                ['name' => 'Vodka', 'measurement' => ['oz' => '2oz', 'ml' => '60ml']],
                ['name' => 'Kahlúa', 'measurement' => '0.5oz'],
                ['name' => 'Espresso', 'measurement' => '1oz'],
                ['name' => 'Simple Syrup', 'measurement' => '0.5oz']
            ]
        ]
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => "Allie Eusebi",
            'email' => "allie.eusebi@test.com",
            'password' => Hash::make('password'),
        ]);

//        $drink = Drink::factory()->create([
//            'name' => 'Manhattan',
//            'owner' => $user->id
//        ]);
//
//        $ingredients = Ingredient::factory(3)->sequence(
//            ['name' => 'Gin'],
//            ['name' => 'Campari'],
//            ['name' => 'Sweet Vermouth'],
//        )->create();
//
//        foreach ($ingredients as $ingredient) {
//            DrinkIngredient::factory()->create([
//                'drink_id' => $drink->id,
//                'ingredient_id' => $ingredient->id,
//                'amount' => '1',
//                'amount_unit' => 'oz'
//            ]);
//        }
    }
}
