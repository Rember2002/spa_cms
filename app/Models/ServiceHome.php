<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHome extends Model
{
    use HasFactory;

    protected $fillable = [

        "image",
        "link",
        "state"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
}
