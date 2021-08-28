<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutUsResource extends JsonResource
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
            'Contenido' => $this->description,
            'Tipo de Contenido' => $this->type,
            'Año' => $this->year,
            'Portada' => $this->image, 

        ];

    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
