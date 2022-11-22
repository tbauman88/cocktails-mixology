<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Drink;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_index_all_ingredients()
    {
        $user = User::factory()->create();

        Drink::factory()->for($user)->hasAttached(
            Ingredient::factory(3),
            ['amount' => "1", "amount_unit" => "oz"],
        )->create();

        Drink::factory()->for($user)->hasAttached(
            Ingredient::factory(6),
            ['amount' => "1", "amount_unit" => "oz"],
        )->create();

        $this->actingAs($user)
            ->getJson(route('ingredients.index'))
            ->assertSuccessful()
            ->assertJsonCount(9)
            ->assertJsonStructure([
                [
                    'id',
                    'name',
                    'drinks',
                    'updated_at',
                    'created_at',
                ]
            ]);
    }
}
