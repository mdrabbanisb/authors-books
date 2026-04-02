<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
{
    return [
        'title' => $this->faker->sentence(3),
        'publisher' => $this->faker->company,
        'published_at' => $this->faker->date(),
        'cover_image' => 'images/covers/default.jpg', 
    ];
}
}