<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionNavBar extends Model
{
    use HasFactory;

    protected $fillable = [

        "name_section",
        "id_section_belong"

    ];

    protected $hidden = [

        "created_at",
        "updated_at"

    ];

    public function sectionNavBar()
    {
        return $this->belongsTo('App\Models\SectionNavBar', 'id_section_belong');
    }
}
