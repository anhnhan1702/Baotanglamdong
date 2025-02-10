<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TrungbayaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Trungbayao::insert([
            ['name'=>'Không gian bên trong'],
            ['name'=>'Không gian bên ngoài'],
            ['name'=>'Hiện vật đã 3D'],
        ]);
    }
}
