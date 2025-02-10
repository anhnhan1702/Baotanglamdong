<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BosuutaphinhanhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Bosuutaphinhanh::insert([
            ['name'=>'Trưng bày'],
            ['name'=>'Triển lãm'],
            ['name'=>'Tư liệu'],
            

        ]);
    
    }
}
