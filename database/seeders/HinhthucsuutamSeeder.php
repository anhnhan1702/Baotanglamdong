<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HinhthucsuutamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Hinhthucsuutam::insert([
            ['name'=>'Sưu tầm',
            // 'soluong'=>20
            ],

            ['name'=>'Khai quật',
            // 'soluong'=>10
            ],

            ['name'=>'Tiếp quản',
            // 'soluong'=>5
            ],

            ['name'=>'Hiến tặng',
            // 'soluong'=>7
            ],

        ]);
    }
}
