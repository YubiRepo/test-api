<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->,
			// 'unit_id' => $this->faker->,
			// 'price' => $this->faker->,
			// 'stock' => $this->faker->,
			// 'description' => null,
			// 'image' => $this->faker->
        ];
    }
}
