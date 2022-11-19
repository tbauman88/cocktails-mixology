<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DrinkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_create_a_drink()
    {
        $user = User::factory()->hasDrinks(5)->create();

        $this->assertCount(5, Drink::all());

        $payload = [
            "user" => $user->id,
            "description" => "",
            "name" => "Negroni",
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "unit" => "oz"],
                ["name" => "Campari", "amount" => "1", "unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "unit" => "oz"]
            ]
        ];

        $response = $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertCreated();


        $this->assertCount(6, Drink::all());

        $ingredients = Ingredient::query()->where('drink_id', $response->json('id'));

        foreach ($ingredients as $ingredient) {
            $this->assertDatabaseHas('drink_ingredient', [
                'drink_id' => $response->json('id'),
                'ingredient_id' => $ingredient->id
            ]);
        }
    }

    public function test_it_will_throw_when_creating_a_duplicate_drink_name()
    {
        $user = User::factory()
            ->hasDrinks(1, ["name" => "Old Fashioned"])
            ->create();

        $payload = [
            "user" => $user->id,
            "description" => "",
            "name" => $user->drinks->first()->name,
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "unit" => "oz"],
                ["name" => "Campari", "amount" => "1", "unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "unit" => "oz"]
            ]
        ];

        $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertUnprocessable();
    }

    public function test_it_will_index_all_drinks()
    {
        $user1 = User::factory()->hasDrinks(10)->create();
        User::factory()->hasDrinks(20)->create();

        $this->actingAs($user1)
            ->getJson(route('drinks.index'))
            ->assertSuccessful()
            ->assertJsonCount(30, null);
    }
}
