<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PhongbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Phongban::insert([
            ['name'=>'Phòng 1'],
            ['name'=>'Phòng 2'],

        ]);
    }
}
