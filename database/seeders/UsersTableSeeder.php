<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Guru 1',
                'email' => 'guru1@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ],
            [
                'name' => 'awaka',
                'email' => 'awaka@example.com',
                'password' => Hash::make('password'),
                'role' => 'student',
            ],
            [
                'name' => 'Guru 2',
                'email' => 'guru2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
            ],
            [
                'name' => 'Siswa 2',
                'email' => 'siswa2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ],
        ]);
    }
}