<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $maxTitleLength = 50;

        return [
            'title'        => Str::limit($this->faker->sentence(6), $maxTitleLength, ''),
            'content'      => $this->faker->paragraphs(3, true),
            'category_id'  => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'user_id'      => User::query()->inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
