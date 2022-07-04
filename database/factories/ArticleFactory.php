<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(mt_rand(2, 10)),
            // "category_id" => $this->faker->unique()->numberBetween(1, Category::count()),
            // "user_id" => $this->faker->unique()->numberBetween(1, User::count()),
            "category_id" => 1,
            "user_id" => 1,
            "content" => $this->faker->paragraph(mt_rand(3, 10)),
            'image' => $this->faker->imageUrl(200, 200, "animals", true),
        ];
    }
}