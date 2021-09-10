<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieService extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_categorie",
        "description",
        "id_service",

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'id_service');
  
    }
}
