<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaoquanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Baoquan::insert([
            ['name'=>'Thường Kỳ'],
            ['name'=>'Trị Liệu'],
            ['name'=>'Tu Sửa'],
        ]);
    }
}
