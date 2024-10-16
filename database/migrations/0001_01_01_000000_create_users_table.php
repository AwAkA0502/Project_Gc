<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users_table', function (Blueprint $table) {
            $table->id(); // Kolom id auto increment
            $table->string('login')->unique(); // Kolom login
            $table->string('password'); // Kolom password
            $table->string('email')->unique(); // Kolom email
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_table');
    }
}
