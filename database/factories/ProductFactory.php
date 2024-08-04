<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price = $this->faker->numberBetween(10000, 1000000);
        $price_sale = $this->faker->numberBetween(1000, $price - 1000);

        return [
            'name' => $this->faker->word(),
            'sku' => $this->faker->unique()->numerify('SKU-#####'),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'price' => $price,
            'price_sale' => $price_sale,
            'quantity' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['published', 'hidden']),
        ];
    }
}
