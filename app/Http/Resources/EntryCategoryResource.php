<?php

namespace App\Http\Resources;

use App\Actions\Time\GetDaysFromMinutes;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->name,
        ];
    }
}