<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesianExperienceHome extends Model
{
    use HasFactory;

    protected $fillable = [

        "image",
        "description",
        "year"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
}
