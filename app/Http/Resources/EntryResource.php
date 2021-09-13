<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'id' => $this->id,
            'title' => $this->title,
            'entry_categories_id' => $this->entry_categories_id,
            'content' => $this->content,
            'created_at' => Carbon::parse($this->created_at)->format('d M Y'),
        ]);
    }
}