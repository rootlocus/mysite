<?php

namespace App\Http\Resources;

use App\Actions\Time\GetDaysFromMinutes;
use Illuminate\Http\Resources\Json\JsonResource;

class TopGameResource extends JsonResource
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
            'id' => $this->appid,
            'name' => $this->name,
            'time' => GetDaysFromMinutes::run($this->playtime_forever),
        ];
    }
}