<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VitrihienvatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Vitrihienvat::insert([
            ['name' => 'Kho',
            'soluong' => 60],
            ['name' => 'Trưng bày',
            'soluong' => 40],
        ]);
    }
}
