<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicOfferResource extends JsonResource
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
            'Oferta' => $this->name_offer,
            'Decripcion' => $this->description,
            'Portada' => $this->image,
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
