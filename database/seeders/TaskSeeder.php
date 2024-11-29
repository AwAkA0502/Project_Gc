<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tugas')->insert([
            [
                'judul' => 'Tugas Matematika',
                'deskripsi' => 'Kerjakan soal latihan bab aljabar.',
                'deadline' => Carbon::now()->addDays(3), // Deadline 3 hari ke depan
                'kelas_id' => 7, // Pastikan ID kelas sesuai dengan data Anda
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tugas Fisika',
                'deskripsi' => 'Laporan percobaan gaya dan gerak.',
                'deadline' => Carbon::now()->addDays(5), // Deadline 5 hari ke depan
                'kelas_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tugas Kimia',
                'deskripsi' => 'Analisis senyawa hidrokarbon.',
                'deadline' => Carbon::now()->addDays(7), // Deadline 7 hari ke depan
                'kelas_id' => 7, // Pastikan ID kelas sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tugas apalah',
                'deskripsi' => 'Analisis senyawa hidrokarbon.',
                'deadline' => Carbon::now()->addDays(7), // Deadline 7 hari ke depan
                'kelas_id' => 8, // Pastikan ID kelas sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tugas itulah',
                'deskripsi' => 'Analisis senyawa hidrokarbon.',
                'deadline' => Carbon::now()->addDays(7), // Deadline 7 hari ke depan
                'kelas_id' => 8, // Pastikan ID kelas sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}