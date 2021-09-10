<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_grade",
        "description",
        "image",
        "id_academic_offer"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
    
    public function academicOffer()
    {
        
        return $this->belongsTo('App\Models\AcademicOffer', 'id_academic_offer');
  
    }

}
