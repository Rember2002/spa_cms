<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'Servicio' => $this->name_service,
            'Descripcion' => $this->description,
            'Enlace' => $this->link,
            'Estado' => $this->state,

        ];
    }
}
