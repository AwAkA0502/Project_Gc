<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tugas'; // Nama tabel di database


    protected $fillable = [
        'judul', // Nama tugas
        'deskripsi', // Deskripsi tugas
        'deadline', // Deadline tugas
        'kelas_id', // Foreign key ke kelas
    ];

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}