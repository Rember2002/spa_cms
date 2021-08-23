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
    
    public function academicOffer()
    {
        
        return $this->belongsTo('App\Models\AcademicOffer', 'id_academic_offer');
  
    }

    public function categorie()
    {

        return $this->morphMany(Categorie::class, 'categorieServiceGrade');
        
    }
}
