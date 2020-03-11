<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsulanOpd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_opd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dinas');
            $table->string('nama');
            $table->string('spek');
            $table->string('merk');
            $table->string('satuan');
            $table->string('jumlah_berkas');
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
        Schema::dropIfExists('usulan_opd');
    }
}
