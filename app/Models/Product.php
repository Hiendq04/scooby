<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'description',
        'image',
        'price',
        'price_sale',
        'quantity',
        'category_id',
        'status',
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
