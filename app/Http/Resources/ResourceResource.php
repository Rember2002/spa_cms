<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceResource extends JsonResource
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
            'Nombre'=> $this->name_resource,
            'Descripcion' => $this->description,
            'Portada' => $this->image,
            'Archivo' => $this->document,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
