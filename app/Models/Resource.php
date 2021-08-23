<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_resource",
        "description",
        "image",
        "document"

    ]; 

    protected $hidden = [

        "created_at",
        "updated_at"

    ];
}
