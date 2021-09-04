<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'Pregunta' => $this->question,
            'Respuesta' => $this->answer,
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
