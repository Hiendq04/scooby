<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'Đang chờ',
            'Đã xác nhận',
            'Đang chuẩn bị hàng',
            'Đang giao hàng',
            'Đã giao hàng',
            'Yêu cầu hủy',
            'Đã hủy',
            'Yêu cầu hoàn hàng',
            'Đang hoàn hàng',
            'Đã hoàn hàng',
        ];

        foreach ($statuses as $status) {
            if (!OrderStatus::where('name', $status)->exists()) {
                OrderStatus::create(['name' => $status]);
            }
        }
    }
}
