<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users_table', function (Blueprint $table) {
            $table->id(); // Ini akan menjadi kolom id dengan auto-increment
            $table->string('login')->unique(); // Login harus unik
            $table->string('password');
            $table->string('email')->unique(); // Email juga harus unik
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_table');
    }
}
