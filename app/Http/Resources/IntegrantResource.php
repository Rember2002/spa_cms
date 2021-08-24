<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IntegrantResource extends JsonResource
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
            'Integrante' => $this->name_integrant,
            'Perfil' => $this->image,
            'Comision' => $this->id_commission,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
