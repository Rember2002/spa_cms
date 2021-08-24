<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewItemResource extends JsonResource
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

            'Titulo' => $this->title,
            'Contenido' => $this->content,
            'Fecha Publicacion' => $this->date,
            'Estado' => $this->state,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
