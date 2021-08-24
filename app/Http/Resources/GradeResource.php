<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
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
            'Grado' => $this->name_grade,
            'Descripcion' => $this->description,
            'Contenido Multimedia' => $this->image,
            'Oferta Academica' => $this->id_academic_offer,

        ];
    }
}
