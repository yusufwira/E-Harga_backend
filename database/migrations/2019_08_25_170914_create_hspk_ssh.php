<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHspkSsh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hspk_ssh', function (Blueprint $table) {
            $table->integer('hspk_id')->unsigned();
            $table->foreign('hspk_id')->references('id')->on('hspk');
            $table->integer('ssh_id')->unsigned();
            $table->foreign('ssh_id')->references('id')->on('ssh');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hspk_ssh');
    }
}
