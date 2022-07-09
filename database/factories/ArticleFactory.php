<?php

namespace Database\Factories;

use App\Models\Category;
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
            "title" => $this->faker->unique()->sentence(4),
            "category_id" => $this->faker->randomDigitNotNull(1, Category::count()),
            "user_id" => 1,
            "content" => $this->faker->paragraph(mt_rand(3, 10)),
            'image' => $this->faker->imageUrl(200, 200, true),
        ];
    }
}