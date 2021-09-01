<?php

namespace App\Models\Shop;

use App\Traits\Shop\HasStatuses;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasStatuses;
    
    protected $fillable = [
        'cart_id',
        //address
        //user
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
