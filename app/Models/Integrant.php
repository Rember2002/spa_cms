<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrant extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_integrant",
        "image",
        "id_comission"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function commision()
    {
        return $this->belongsTo('App\Models\Commision', 'id_comission');
    }
}
