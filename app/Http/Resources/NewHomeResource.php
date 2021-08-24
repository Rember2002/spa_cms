<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewHomeResource extends JsonResource
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

            'Ïd' => $this->id,
            'Contenido Multimedia' => $this->image,
            'Estado' => $this->status,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
