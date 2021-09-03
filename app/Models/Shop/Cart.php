<?php

namespace App\Models\Shop;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use SoftDeletes, Uuid;
    
    protected $fillable = [
        'uuid',
        'user_id',
        'address_id',
    ];

    protected $appends = [
        'total_amount',
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::check() ? Auth::user()->id : null);
        });
    }

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
