<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieGrade extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_categorie",
        "description",
        "id_grade",

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'id_grade');
  
    }
}
