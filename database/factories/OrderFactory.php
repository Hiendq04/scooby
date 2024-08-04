<?php

namespace Database\Factories;

use App\Models\{
    User,
    Voucher,
    OrderStatus,
};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'status_id' => OrderStatus::inRandomOrder()->first()->id,
            'voucher_id' => $this->faker->optional()->randomElement(Voucher::pluck('id')),
            'order_number' => $this->faker->unique()->numerify('ORD#####'),
            'original_amount' => $this->faker->randomFloat(2, 20, 200),
            'discounted_amount' => $this->faker->randomFloat(2, 10, 150),
            'total_amount' => $this->faker->randomFloat(2, 10, 150),
            'shipping_address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
