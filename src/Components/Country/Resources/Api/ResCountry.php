<?php

namespace App\Components\Country\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ResCountry extends JsonResource
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
            'country_id'        => $this->id,
            'name'              => $this->name,
            'flag'              => $this->display_image,
            'country_code'      => $this->country_code,
            'country_number'    => $this->country_number,
       ];

    }
}
