<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(OrderStatusSeeder::class);

        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(30)->create();
        // \App\Models\Brand::factory(30)->create();
        \App\Models\Voucher::factory(30)->create();
        \App\Models\Banner::factory(30)->create();
        \App\Models\Product::factory(30)->create();
        \App\Models\Order::factory(20)->create();
        \App\Models\OrderDetail::factory(50)->create();
    }
}
