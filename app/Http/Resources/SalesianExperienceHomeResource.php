<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesianExperienceHomeResource extends JsonResource
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
            'Descripcion' => $this->description,
            'Año' => $this->year,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
