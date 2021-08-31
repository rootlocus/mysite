<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
    ];

    protected $appends = [
        'total_amount',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        }, 0), 2);
    }
}
