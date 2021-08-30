<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cart_id',
        'status_id',
    ];
}
