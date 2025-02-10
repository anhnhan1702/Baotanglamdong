<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChucvuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Chucvu::insert([
            ['name'=>'Administrator'],
            ['name'=>'Nhân viên'],
            ['name'=>'Trưởng phòng'],
            ['name'=>'Trưởng Kho'],
            ['name'=>'Phó giám đốc'],
            ['name'=>'Giám đốc'],
        ]);
    }
}
