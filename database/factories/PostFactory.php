<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(10),
            'status' => $this->faker->boolean(),
            'author_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
