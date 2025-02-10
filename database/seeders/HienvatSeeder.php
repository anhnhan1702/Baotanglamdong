<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HienvatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Hienvat::insert([
            ['name'=>'Dao',
            'so_ky_hieu'=>'BTLD1',
            'loaihienvat_id'=>'1',
            'bosuutap_id'=>'31',
            'checkxuatnhap'=>0,
            ],
            ['name'=>'Xà gạc',
            'so_ky_hieu'=>'BTLD2',
            'loaihienvat_id'=>'1',
            'bosuutap_id'=>'25',
            'checkxuatnhap'=>0,
            ],
            ['name'=>'Gàu tát nước',
            'so_ky_hieu'=>'BTLD3',
            'loaihienvat_id'=>'1',
            'bosuutap_id'=>'10',
            'checkxuatnhap'=>0,
            ],
            ['name'=>'Gùi',
            'so_ky_hieu'=>'BTLD4',
            'loaihienvat_id'=>'4',
            'bosuutap_id'=>'12',
            'checkxuatnhap'=>0,
            ],
            ['name'=>'Chụp mối',
            'so_ky_hieu'=>'BTLD5',
            'loaihienvat_id'=>'3',
            'bosuutap_id'=>'13',
            'checkxuatnhap'=>0,
            ],
            ['name'=>'Giỏ',
            'so_ky_hieu'=>'BTLD6',
            'loaihienvat_id'=>'2',
            'bosuutap_id'=>'14',
            'checkxuatnhap'=>0,
            ],
        ]);
    }
}
