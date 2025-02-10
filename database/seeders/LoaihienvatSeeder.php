<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LoaihienvatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Loaihienvat::insert([
            ['name'=>'Gốc'],
            ['name'=>'Tạm thời'],
            ['name'=>'Khoa học phụ'],
            ['name'=>'Tư liệu'],
        ]);
    }
}
