<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name_grade' => 'Septimo Grado',
                'description' => 'Descripcion correspondiente al grado mencionado, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis ut, magnam blanditiis obcaecati animi cum saepe! Necessitatibus similique illum explicabo ex! Autem eligendi aperiam optio deleniti corrupti ad, quidem consectetur.',
                'image' => 'url/image',
                'id_academic_offer' => 1,
            ],

            [
                'name_grade' => 'Octavo Grado',
                'description' => 'Descripcion correspondiente al grado mencionado, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis ut, magnam blanditiis obcaecati animi cum saepe! Necessitatibus similique illum explicabo ex! Autem eligendi aperiam optio deleniti corrupti ad, quidem consectetur.',
                'image' => 'url/image',
                'id_academic_offer' => 1,
            ],

            [
                'name_grade' => 'Noveno Grado',
                'description' => 'Descripcion correspondiente al grado mencionado, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis ut, magnam blanditiis obcaecati animi cum saepe! Necessitatibus similique illum explicabo ex! Autem eligendi aperiam optio deleniti corrupti ad, quidem consectetur.',
                'image' => 'url/image',
                'id_academic_offer' => 1,
            ],

            [
                'name_grade' => 'Tecnico Vocacional Desarrollo de Software',
                'description' => 'Descripcion correspondiente al grado mencionado, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis ut, magnam blanditiis obcaecati animi cum saepe! Necessitatibus similique illum explicabo ex! Autem eligendi aperiam optio deleniti corrupti ad, quidem consectetur.',
                'image' => 'url/image',
                'id_academic_offer' => 2,
            ],

            [
                'name_grade' => 'Tecnico Industrial Automotriz',
                'description' => 'Descripcion correspondiente al grado mencionado, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis ut, magnam blanditiis obcaecati animi cum saepe! Necessitatibus similique illum explicabo ex! Autem eligendi aperiam optio deleniti corrupti ad, quidem consectetur.',
                'image' => 'url/image',
                'id_academic_offer' => 2,
            ],

        ]);
    }
}
