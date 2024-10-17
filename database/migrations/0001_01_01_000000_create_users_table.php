<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID pengguna
            $table->string('login')->unique(); // Kolom login
            $table->string('password'); // Kolom password
            $table->string('email')->unique(); // Kolom email
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users'); // Menghapus tabel users jika ada
    }
}
