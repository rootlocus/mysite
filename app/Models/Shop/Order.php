<?php

namespace App\Models\Shop;

use App\Traits\Shop\HasStatuses;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasStatuses;
    
    protected $fillable = [
        'cart_id',
        'status',
        //address
        //user
    ];

    protected $appends = [
        'total_amount',
        'status',
        'status_timestamp',
        'order_placed_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        }, 0), 2);
    }

    public function getOrderPlacedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M Y h:m');
    }
}
