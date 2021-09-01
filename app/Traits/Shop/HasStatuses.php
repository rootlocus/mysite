<?php

namespace App\Traits\Shop;

use App\Models\Shop\Status;

trait HasStatuses
{
    public function statuses()
    {
        return $this->morphMany(Status::class, 'model', 'model_type');
    }
}