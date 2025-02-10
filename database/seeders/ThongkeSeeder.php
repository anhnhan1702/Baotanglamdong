<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThongkeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Thongke::insert([
            ['name'=>'Báo cáo hiện vật theo hình thức sưu tầm'],
            ['name'=>'Báo cáo hiện vật theo danh mục chất liệu'],
            ['name'=>'Báo cáo hiện vật theo loại hiện vật'],
            ['name'=>'Báo cáo theo các tiêu chí phân loại trong sưu tập hiện vật (sưu tập)'],
            ['name'=>'Báo cáo thống kê theo vị trí hiện vật'],
            ['name'=>'Báo cáo theo các mục kho bảo quản'],
            ['name'=>'Báo cáo số lượng theo thời gian'],
        ]);
    }
}
