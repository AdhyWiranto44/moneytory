<?php

namespace Database\Factories;

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
            'status_id' => 2,
            'unit_id' => $this->faker->numberBetween(1, 10),
            'code' => 'PROD' . $this->faker->numberBetween(1, 999),
            'name' => $this->faker->firstName() . " " . $this->faker->firstName(),
            'base_price' => $this->faker->numberBetween(12500, 125000),
            'profit' => $this->faker->numberBetween(2000, 25000),
            'stock' => $this->faker->numberBetween(5, 100),
            'minimum_stock' => $this->faker->numberBetween(1, 10),
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
