<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'image',
    ];
}
