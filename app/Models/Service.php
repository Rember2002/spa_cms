<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_service",
        "description",
        "link",
        "state"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function images()
    {

        return $this->morphMany(Image::class, 'imageServiceNews');

    }

    public function categorie()
    {

        return $this->morphMany(Categorie::class, 'categorieServiceGrade');
        
    }
}
