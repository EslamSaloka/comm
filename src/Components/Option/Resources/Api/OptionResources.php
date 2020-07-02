<?php

namespace App\Components\Option\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OptionResources extends ResourceCollection {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) {
        return [
            'category_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }

}
