<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BosuutapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Bosuutap::insert([
            [  
                'name'=>'Thiên nhiên',
                'parent_id' => null
            ],
            [
                'name'=>'Mẫu khoáng sản',
                'parent_id' => 1,
            ],
            [
                'name'=>'Mẫu động vật',
                'parent_id' => 1
            ],
            [
                'name'=>'Mẫu thực vật',
                'parent_id' => 1
            ],
            [
                'name'=>'Mẫu khác',
                'parent_id' => 1
            ],
            // 
            [
                'name'=>'Đà Lạt xưa và nay',
                'parent_id' => null
            ],
            [
                'name'=>'Đà Lạt xưa',
                'parent_id' => 6
            ],
            [
                'name'=>'Đà Lạt ngày nay',
                'parent_id' => 6
            ],
            // 
            [
                'name'=>'Hiện vật khảo cổ',
                'parent_id' => null
            ],
            [
                'name'=>'Di tích khảo cổ Cát Tiên',
                'parent_id' => 9
            ],
            [
                'name'=>'Di chỉ mộ táng Đại Lảng',
                'parent_id' => 9
            ],
            [
                'name'=>'Di chỉ mộ táng Đại Lào',
                'parent_id' => 9
            ],
            [
                'name'=>'Di chỉ mộ táng Lộc Châu',
                'parent_id' => 9
            ],
            [
                'name'=>'Di chỉ mộ táng Đại Đờn',
                'parent_id' => 9
            ],
            [
                'name'=>'Di chỉ Hoàn Kiếm',
                'parent_id' => 9
            ],
            [
                'name'=>'Hiện vật cung đình triều Nguyễn',
                'parent_id' => 9
            ],
            [
                'name'=>'Các phát hiện rải rác',
                'parent_id' => 9
            ],
            [
                'name'=>'Hiện vật tiếp quản, hiến tặng',
                'parent_id' => 9
            ],
         
            // 
            [
                'name'=>'Văn hóa dân tộc',
                'parent_id' => null
            ],
            [
                'name'=>'Dân tộc Mạ',
                'parent_id' => 19
            ],
            [
                'name'=>'Dân tộc Cơho',
                'parent_id' => 19
            ],
            [
                'name'=>'Dân tộc Churu',
                'parent_id' => 19
            ],
            [
                'name'=>'Các dân tộc khác',
                'parent_id' => 19
            ],
              // 
            [
                'name'=>'Lịch sử kháng chiến',
                'parent_id' => null
            ],
            [
                'name'=>'Thời kỳ chống Pháp',
                'parent_id' => 24
            ],
            [
                'name'=>'Thời kỳ chống Mỹ',
                'parent_id' => 24
            ],
            // 
            [
                'name'=>'Xây dụng CNXH',
                'parent_id' => null
            ],
            [
                'name'=>'Giai đoạn trước Đổi mới',
                'parent_id' => 27
            ],
            [
                'name'=>'Giai đoạn Sau Đổi mới',
                'parent_id' => 27
            ],
           // 
           [
            'name'=>'Các tác phẩm nghệ thuật',
            'parent_id' => null
            ],
            [
                'name'=>'Tranh',
                'parent_id' => 30
            ],
            [
                'name'=>'Tượng',
                'parent_id' => 30
            ],
            [
                'name'=>'Khác',
                'parent_id' => 30
            ],
            
        ]);
    }
}