<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Mengimpor Authenticatable
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Menggunakan Authenticatable sebagai kelas dasar
{
    use Notifiable;

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
}
