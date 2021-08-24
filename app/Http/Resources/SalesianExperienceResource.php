<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesianExperienceResource extends JsonResource
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
            'Evento' => $this->name_evento,
            'Descripcion' => $this->description,
            'Fecha' => $this->date,
            'Lugar' => $this->place,
            'Portada' => $this->image,
            'Vivencia' => $this->type,

        ];
    }
}
