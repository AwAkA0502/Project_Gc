<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->time('waktu')->nullable()->after('deadline'); // Tambahkan kolom waktu setelah deadline
            $table->integer('nilai')->nullable()->after('waktu'); // Tambahkan kolom nilai setelah waktu
            $table->string('file_path')->nullable()->after('nilai'); // Tambahkan kolom file_path setelah nilai
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['waktu', 'nilai', 'file_path']); // Hapus kolom yang ditambahkan
        });
    }
}
