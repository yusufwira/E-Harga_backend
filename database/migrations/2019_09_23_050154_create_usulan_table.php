<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('usulan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipe_usulan');
            $table->string('nama');
            $table->string('merk')->nullable();
            $table->string('spek')->nullable();
            $table->string('satuan')->nullable();
            $table->string('referensi')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('path_file')->nullable();
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
        Schema::dropIfExists('usulan');
    }
}
