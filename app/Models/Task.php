<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Model Task
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'tugas_id', 'id'); // Relasi ke submission
    }

    // Pastikan tabel yang digunakan adalah "tugas"
    protected $table = 'tugas';

    // Tambahkan kolom yang bisa diisi
    protected $fillable = [
        'kelas_id', 'judul', 'deskripsi', 'deadline', 'waktu', 'nilai', 'file_path',
    ];
}