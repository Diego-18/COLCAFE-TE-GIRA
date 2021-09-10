<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('celular');
            $table->string('tel_adic');
            $table->integer('id_depart');
            $table->integer('id_ciudad');
            $table->integer('id_tipo_documento');
            $table->integer('estado');
            $table->timestamps();

          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
