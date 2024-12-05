<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
// Model Submission
public function user()
{
    return $this->belongsTo(User::class, 'siswa_id');
}

public function tugas()
{
    return $this->belongsTo(Tugas::class, 'tugas_id', 'id'); // Relasi ke tugas
}

    use HasFactory;

    protected $table = 'submission'; // Nama tabel Anda

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_url',
        'nilai',
        'feedback',
    ];
}