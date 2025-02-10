<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuanlytrungbaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Quanlytrungbay::insert([
            ['name'=>'Nhà trưng bày chính'],
            ['name'=>'Cung Nam Phương Hoàng hậu'],
            ['name'=>'Khu nhà sàn'],
            ['name'=>'Di tích Nhà lao thiếu nhi'],
            ['name'=>'Di tích Cát Tiên'],
            ['name'=>'Triển lãm'],
        ]);
    }
}
