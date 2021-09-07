<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
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
            'Comision' => $this->name_commission,
            'Imagen' => $this->image,
            'Consejo' => $this->id_student_council,
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
