<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChatlieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Chatlieu::insert([
            ['name'=>'Gốm, sành sứ: ký hiệu: S:'],
            ['name'=>'Đá: ký hiệu: Đa:'],
            ['name'=>'Kim loại: ký hiệu: Kl:'],
            ['name'=>'Đồ gỗ, tre nứa: ký hiệu: Đm'],
            ['name'=>'Thủy tinh: ký hiệu:Tt:'],
            ['name'=>'Da ký hiệu: Da:'],
            ['name'=>'Gạch: ký hiệu: Ga:'],
            ['name'=>'Nhựa: ký hiệu: Nh:'],
            ['name'=>'Tổng hợp: ký hiệu: Th:'],
            ['name'=>'Chất liệu khác'],
        ]);
    }
}
