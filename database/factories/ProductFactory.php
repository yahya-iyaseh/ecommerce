<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->productName,
            'description' => $this->faker->sentences(3, true),
            'category_id' => Category::inRandomOrder()->limit(1)->first()->id,
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(null, 0, 999),
            'compare_price' => $this->faker->randomFloat(null, 1000, 1999),
            'quantity' => $this->faker->randomDigitNotNull(),
            'sku' => $this->faker->unique()->word(),

        ];
    }
}
