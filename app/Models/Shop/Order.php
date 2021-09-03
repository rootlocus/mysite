<?php

namespace App\Models\Shop;

use App\Traits\Shop\HasStatuses;
use App\Traits\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasStatuses, Uuid;
    
    protected $fillable = [
        'uuid',
        'cart_id',
        'status',
        'user_id',
        'address_id',
    ];

    protected $appends = [
        'total_amount',
        'status',
        'status_timestamp',
        'order_placed_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::check() ? Auth::user()->id : null);
        });
    }

    
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
