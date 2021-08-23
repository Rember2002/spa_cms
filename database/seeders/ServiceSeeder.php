<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([

            [
                'name_service' => 'Escuela de Idiomas',
                'description' => 'Descripcion del servicio Escuela de Idiomas, Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, accusamus ipsa commodi quasi suscipit consectetur aliquam, unde totam fugiat ullam officiis voluptatem tempore eum repudiandae omnis facere harum hic nisi?',
                'link' => 'url/Escuela de Idiomas', 
            ],
            
            [
                'name_service' => 'Escuela de Natacion',
                'description' => 'Descripcion del servicio Escuela de Natacion, Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, accusamus ipsa commodi quasi suscipit consectetur aliquam, unde totam fugiat ullam officiis voluptatem tempore eum repudiandae omnis facere harum hic nisi?',
                'link' => 'url/Escuela de Natacion', 
            ],

            [
                'name_service' => 'Centro de Formacion Profesional',
                'description' => 'Descripcion del servicio Centro de Formacion Profesional, Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, accusamus ipsa commodi quasi suscipit consectetur aliquam, unde totam fugiat ullam officiis voluptatem tempore eum repudiandae omnis facere harum hic nisi?',
                'link' => 'url/Centro de Formacion Profesional', 
            ],

        ]);
    }
}
