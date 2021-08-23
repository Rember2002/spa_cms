<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewItem extends Model
{
    use HasFactory;

    protected $fillable = [

        "title",
        "content",
        "date",
        "state"

    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageServiceNews');
    }
}
