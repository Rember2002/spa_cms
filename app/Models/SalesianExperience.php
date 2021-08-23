<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesianExperience extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_event",
        "description",
        "date",
        "place",
        "image"

    ];
}
