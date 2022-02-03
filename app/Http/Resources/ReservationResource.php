<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            'name' => $this->name,
            'reserve_time' => $this->reserve_time,
            'reserve_items' => $this->reserve_items,
            'phone' => $this->phone,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
