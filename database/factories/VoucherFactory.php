<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => fake()->lexify('??????????'),
            'limit' => '20',
            'value' => '50000',
            'condition' => '50000',
            'type' => 'free_ship',
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'status' => 'active',
        ];
    }
}
