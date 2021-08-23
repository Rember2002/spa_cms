<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [

        "image",
        "image_id",
        "image_type",

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function imageServiceNews()
    {
        return $this->morphTo();
    } 
}
