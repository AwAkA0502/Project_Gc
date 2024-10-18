<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToUsersTable extends Migration
{    
    public function up()
    {
        // Tambahkan kolom 'name' ke tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(); // Sesuaikan dengan kebutuhanmu
        });
    }

    public function down()
    {
        // Menghapus kolom 'name' jika rollback
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
