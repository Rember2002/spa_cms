<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StrategicAllieResource extends JsonResource
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
            'Aliado' => $this->name_ally,
            'Logo' => $this->image,
            'Descripcion' => $this->description,
        
        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
