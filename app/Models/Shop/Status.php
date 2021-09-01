<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'status_timestamp_at',
        'name',
        'model_type',
        'model_id',
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function statusable()
    {
        return $this->morphTo();
    }
}
