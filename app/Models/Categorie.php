<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [

        "name",
        "description",
        "categories_id",
        "categories_type"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function categorieServiceGrade()
    {
        return $this->morphTo();
    }
}
