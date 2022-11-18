<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Drink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class DrinkControllerTest extends TestCase
{
    use RefreshDatabase;

//    use DatabaseTransactions;

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
            ]];

        $this->actingAs($user)
            ->postJson(route('drinks.store'), $payload)
            ->assertCreated();


        $this->assertCount(6, Drink::all());
    }
}
