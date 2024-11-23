<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->string('nama_pelajaran');
            $table->text('deskripsi')->nullable();
            $table->string('kode_kelas', 10)->unique();
            $table->unsignedBigInteger('guru_id'); // ID pengguna yang membuat kelas
            $table->timestamps();

            // Foreign key untuk guru (relasi ke tabel users)
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}