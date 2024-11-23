<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserKelasTable extends Migration
{
    public function up()
    {
        Schema::create('user_kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->unique(['user_id', 'kelas_id']); // Mencegah duplikasi
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_kelas');
    }
}