<?php

namespace Database\Factories;

use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrinkFactory extends Factory
{
    protected $model = Drink::class;

    /** Define the model's default state. */
    public function definition(): array
    {
        return [
            "name" => $this->faker->words(rand(1, 6), true),
            "description" => $this->faker->paragraph(),
            "published" => $this->faker->boolean(),
            "save_count" => $this->faker->randomDigit()
        ];
    }
}
