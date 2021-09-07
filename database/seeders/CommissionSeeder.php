<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commissions')->insert([

            [
                'name_commission' => 'Comunicaciones',
                'image' => 'url/comunicaciones',
                'id_student_council' => 1,
            ],
            
            [
                'name_commission' => 'Deportiva',
                'image' => 'url/desportiva',
                'id_student_council' => 1,
            ],

            [
                'name_commission' => 'Evangelizacion',
                'image' => 'url/evangelizacion',
                'id_student_council' => 1,
            ],

        ]);
    }
}
