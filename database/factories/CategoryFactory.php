<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'name' => $this->faker->department,
            'description' => $this->faker->text(),
            'created_at' => now(),
            'image' => $this->faker->imageUrl()
        ];
    }
}
