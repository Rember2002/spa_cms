<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_comismission",
        "image",
        "id_student_council"

    ];

    public function studentCouncil()
    {

        return $this->belongsTo('App\Models\StudentCouncil', 'id_student_council');

    }
}
