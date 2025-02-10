<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuanlyhinhanhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Quanlyhinhanh::insert([
            ['name'=>'Quản lý hình ảnh'],
        ]);

    }
}
