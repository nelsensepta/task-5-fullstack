<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "NelsenSepta",
            "email" => "nelsensepta@gmail.com",
            "password" => bcrypt("septaAdmin"),
        ]);

        Category::create([
            "name" => "Bola",
            "user_id" => 1,
        ]);

        Article::factory(10)->create();

    }
}