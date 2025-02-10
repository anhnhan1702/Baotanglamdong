<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Media::insert([
            ['name'=>'File tư liệu'],
            ['name'=>'Ghi âm'],
            ['name'=>'Sách, tạp chí']
            

        ]);
    }
}
