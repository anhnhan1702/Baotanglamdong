<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        \App\Models\User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 1,
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'nhanvien',
                'email' => 'nhanvien@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 2,
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'truongphong',
                'email' => 'truongphong@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 3,
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'truongkho',
                'email' => 'truongkho@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 4,
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'phogiamdoc',
                'email' => 'phogiamdoc@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 5,
                'remember_token' => Str::random(10)
            ],
            [
                'name' => 'giamdoc',
                'email' => 'giamdoc@mayviet.net',
                'email_verified_at' => now(),
                'password' => Hash::make('secret'), // password
                'gender' => 'male',
                'active' => 1,
                'chucvu_id' => 6,
                'remember_token' => Str::random(10)
            ]
        ]);

        // Fake users
        
    }
}