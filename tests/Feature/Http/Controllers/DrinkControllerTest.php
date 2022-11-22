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

        $payload = $this->drinkPayload($user);

        $response = $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertCreated();

        $this->assertCount(6, Drink::all());
        $this->assertIngredients($response);
    }

    public function test_it_will_create_a_drink_makred_as_public()
    {
        $user = User::factory()->create();

        $payload = array_merge($this->drinkPayload($user), ['published' => true]);

        $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertCreated()
            ->assertJsonFragment(['public' => true]);
    }

    public function test_it_will_throw_when_creating_a_duplicate_drink_name()
    {
        $user = User::factory()->hasDrinks(1, ["name" => "Old Fashioned"])->create();

        $payload = [
            "user" => $user->id,
            "name" => $user->drinks->first()->name,
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "unit" => "oz"],
                ["name" => "Campari", "amount" => "1", "unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "unit" => "oz"]
            ]
        ];

        $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors('name');
    }

    public function test_it_will_index_all_drinks()
    {
        $user = User::factory()->hasDrinks(10)->create();
        Drink::factory(20)->forUser()->create();

        $this->actingAs($user)
            ->getJson(route('drinks.index'))
            ->assertSuccessful()
            ->assertJsonCount(30);
    }

    public function test_it_will_update_drink_with_saved_count()
    {
        self::markTestSkipped();
    }

    private function assertIngredients($response)
    {
        $ingredients = Ingredient::query()->where('drink_id', $response->json('id'));

        foreach ($ingredients as $ingredient) {
            $this->assertDatabaseHas('drink_ingredient', [
                'drink_id' => $response->json('id'),
                'ingredient_id' => $ingredient->id
            ]);
        }
    }

    private function drinkPayload(User $user)
    {
        return [
            "user" => $user->id,
            "description" => "",
            "name" => "Negroni",
            "ingredients" => [
                ["name" => "Gin", "amount" => "1", "unit" => "oz"],
                ["name" => "Campari", "amount" => "1", "unit" => "oz"],
                ["name" => "Sweet Vermouth", "amount" => "1", "unit" => "oz"]
            ]
        ];
    }
}
