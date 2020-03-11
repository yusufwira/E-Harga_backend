<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsbSshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asb_ssh', function (Blueprint $table) {
            $table->integer('asb_id')->unsigned();
            $table->foreign('asb_id')->references('id')->on('asb');
            $table->integer('ssh_id')->unsigned();
            $table->foreign('ssh_id')->references('id')->on('ssh');
            $table->string('jumlah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asb_ssh');
    }
}
