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
            'Portada' => $this->image,
            'Consejo Estudiantil' => $this->id_student_council,

        ];
    }

    public function with($request)
    {
        return [

            'response' => true,

        ];
    }
}
