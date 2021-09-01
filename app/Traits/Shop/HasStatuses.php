<?php

namespace App\Traits\Shop;

use App\Models\Shop\Status;
use Carbon\Carbon;

trait HasStatuses
{
    public function statuses()
    {
        return $this->morphMany(Status::class, 'model', 'model_type');
    }

    public function getStatusAttribute()
    {
        return $this->statuses()->orderByDesc('status_timestamp_at')->first()->name;
    }

    public function getStatusTimestampAttribute()
    {
        return Carbon::parse($this->statuses()->orderByDesc('status_timestamp_at')->first()->status_timestamp_at)->format('d M Y h:m');
    }
}