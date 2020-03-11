<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserOpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_opd', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->string('dinas');
            $table->string('email')->nullable();;
            $table->string('no_telp')->nullable();;
            $table->string('status');
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
        Schema::dropIfExists('user_opd');
    }
}
