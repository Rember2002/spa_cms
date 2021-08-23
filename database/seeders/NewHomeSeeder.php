<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('new_homes')->insert([

            [
                'image' => 'url1',
            ],

            [
                'image' => 'url2',
            ],
            
            [
                'image' => 'url3',
            ],

        ]);
    }
}
