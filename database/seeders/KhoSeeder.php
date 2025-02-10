<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Kho::insert([
            ['name'=>'Khảo cổ'],
            ['name'=>'Tổng hợp'],

        ]);
    }
}
