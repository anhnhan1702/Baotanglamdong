<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DonviSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Donvi::insert([
            ['name'=>'1'],
            ['name'=>'2'],
            

        ]);
    }
}
