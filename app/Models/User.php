<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Mengimpor Authenticatable
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Menggunakan Authenticatable sebagai kelas dasar
{
    use Notifiable;

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas', 'user_id', 'kelas_id')->withTimestamps();
    }

    protected $fillable = [
        'login', 'password', 'email',
    ];

    // Jika Anda ingin mengatur kunci utama dan lainnya
    protected $hidden = [
        'password', // Menyembunyikan password dari hasil pencarian
    ];

    // Jika Anda perlu menggunakan bcrypt untuk password
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function classes()
{
    return $this->belongsToMany(ClassModel::class);
}

}
