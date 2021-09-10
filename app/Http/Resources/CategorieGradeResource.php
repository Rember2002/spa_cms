<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorieGradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);

        return [

            'Id' => $this->id,
            'Categoria' => $this->name_categorie,
            'Descripcion' => $this->description,
            'GradeId' => $this->id_grade,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
