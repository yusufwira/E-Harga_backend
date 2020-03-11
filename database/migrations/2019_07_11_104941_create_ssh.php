<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('nama');
            $table->string('spek')->nullable();
            $table->string('merk')->nullable();
            $table->string('satuan')->nullable();
            $table->string('status')->nullable();
            $table->string('tag_pencarian');
            $table->string('nama_toko_survey1');
            $table->string('merk_survey1');
            $table->string('harga_survey1');
            $table->string('keterangan_survey1');
            $table->string('file_survey1')->nullable();
            $table->string('nama_toko_survey2')->nullable();
            $table->string('merk_survey2')->nullable();
            $table->string('harga_survey2')->nullable();
            $table->string('keterangan_survey2')->nullable();
            $table->string('file_survey2')->nullable();
            $table->string('nama_toko_survey3')->nullable();
            $table->string('merk_survey3')->nullable();
            $table->string('harga_survey3')->nullable();
            $table->string('keterangan_survey3')->nullable();
            $table->string('file_survey3')->nullable();
            $table->string('nama_toko_survey4')->nullable();
            $table->string('merk_survey4')->nullable();
            $table->string('harga_survey4')->nullable();
            $table->string('keterangan_survey4')->nullable();
            $table->string('file_survey4')->nullable();
            $table->string('harga_final');
            $table->string('alasan');
            $table->string('file_alasan')->nullable();
             
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
        Schema::dropIfExists('ssh');
    }
}
