<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicOffer extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_offer",
        "description",
        "image",
        "state"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
}
