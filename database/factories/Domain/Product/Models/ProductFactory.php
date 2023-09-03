<?php

namespace Database\Factories\Domain\Product\Models;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = 'Domain\Product\Models\Product';
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->numberBetween($min = 1500, $max = 6000),
            'inventory' => fake()->randomDigit,
        ];
    }
}
