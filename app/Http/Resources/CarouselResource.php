<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarouselResource extends JsonResource
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

            'Id' => $this->id,
            'Titulo' => $this->name,
            'Estado' => $this->state,
            'Imagen' => $this->image,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
