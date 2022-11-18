<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->hasAccount()
            ->create([
                "name" => "Allie Eusebi",
                "email" => "allie.eusebi@cocktails.com",
                'password' => Hash::make('password'),
            ]);

//        User::factory()
//            ->count(10)
//            ->hasAccount()
//            ->create([
//                'password' => Hash::make('password'),
//            ]);
    }
}
