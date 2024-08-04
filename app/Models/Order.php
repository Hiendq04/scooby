<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'status_id',
        'voucher_id',
        'order_number',
        'email',
        'original_amount',
        'discounted_amount',
        'total_amount',
        'shipping_address',
        'phone',
        'note',
        'payment_method',
        'is_paid',
    ];

    // Một đơn hàng thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Một đơn hàng có nhiều chi tiết đơn hàng
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Một đơn hàng thuộc về một trạng thái
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
