<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    // Relasi dengan model User (many-to-many) untuk anggota kelas
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_kelas', 'kelas_id', 'user_id')->withTimestamps();
    }

    // Relasi dengan model Task (tugas) (One to Many)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'kelas_id', 'id'); // Relasi one-to-many
    }

    // Relasi dengan model User (guru)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi dengan model User (guru)
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Fungsi untuk menampilkan kelas bersama dengan relasi users
    public function show($id)
    {
        $kelas = Kelas::with('users')->findOrFail($id);
        return view('class-page', compact('kelas'));
    }

    protected $fillable = [
        'nama_kelas',
        'nama_pelajaran',
        'deskripsi',
        'kode_kelas',
        'guru_id',
    ];
}
