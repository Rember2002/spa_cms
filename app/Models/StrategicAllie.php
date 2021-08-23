<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrategicAllie extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_ally",
        "image",
        "descripton"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
}
