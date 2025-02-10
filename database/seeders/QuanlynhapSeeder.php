<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class quanlynhapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     \App\Models\Nhap::create([
            'name' => ''  
        ]);
    }
}
