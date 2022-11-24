<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_will_list_all_user_drinks()
    {
        User::factory(4)->hasAccount()->hasDrinks(rand(1, 5))->create();
        $user = User::factory()->hasAccount()->hasDrinks(20)->create();

        $this->actingAs($user)
            ->getJson(route('user.drinks.index', $user))
            ->assertSuccessful()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'account' => [
                    'bio'
                ],
                'drinks' => [
                    ['id', 'name']
                ]
            ])
            ->assertJsonCount(20, 'drinks');
    }
}
