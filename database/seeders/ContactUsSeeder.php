<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_us')->insert([

            [
                'phone' => '2234-6000',
                'direction' => 'Avenida Aguilares 218 San Salvador CP, 1101',
                'year' => 2021
            ],

        ]);
    }
}
