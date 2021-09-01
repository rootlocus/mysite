<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'description',
        'image',
    ];

    protected $appends = [
        'total_amount',
    ];

    public function order()
    {
        return $this->belongsto(Order::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->price * $this->quantity, 2);
    }
}
