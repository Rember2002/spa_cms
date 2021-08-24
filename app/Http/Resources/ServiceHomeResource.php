<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceHomeResource extends JsonResource
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
            'Portada' => $this->image,
            'Enlace' => $this->link,
            'Estado' => $this->state,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
