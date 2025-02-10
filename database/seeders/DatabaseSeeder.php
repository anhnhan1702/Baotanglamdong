<?php

namespace Database\Seeders;

use App\Models\Chucvu;
use App\Models\Hienvat;
use App\Models\Phucapthamnien;
use App\Models\User;
use App\Models\Vitrihienvat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     
        $this->call(UserSeeder::class);
        $this->call(VitrihienvatSeeder::class);
        $this->call(HinhthucsuutamSeeder::class);
        $this->call(BosuutapSeeder::class);
        $this->call(KhoSeeder::class);
        $this->call(TrungbayaoSeeder::class);
        $this->call(QuanlytrungbaySeeder::class);
        $this->call(ChatlieuSeeder::class);
        $this->call(LoaihienvatSeeder::class);
        // $this->call(HienvatSeeder::class);
        $this->call(BaoquanSeeder::class);
        $this->call(ThongkeSeeder::class);
        $this->call(QuanlyhinhanhSeeder::class);
        $this->call(DonviSeeder::class);
        $this->call(ChucvuSeeder::class);
        $this->call(PhongbanSeeder::class);
        $this->call(BosuutaphinhanhSeeder::class);
        $this->call(MediaSeeder::class);
    }
}
