<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorieServiceResource extends JsonResource
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
            'Categoria' => $this->name_categorie,
            'Descripcion' => $this->description,
            'ServicioId' => $this->id_service,
            'Servicio' => $this->name_service,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
