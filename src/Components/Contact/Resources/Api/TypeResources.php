<?php

namespace App\Components\Contact\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResources extends JsonResource
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
            'type_id'     => $this->id,
            'text'        => $this->name,
       ];

    }
}
