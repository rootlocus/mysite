<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

}