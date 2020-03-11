<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHspkSbuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hspk_sbu', function (Blueprint $table) {
            $table->integer('hspk_id')->unsigned();
            $table->foreign('hspk_id')->references('id')->on('hspk');
            $table->integer('sbu_id')->unsigned();
            $table->foreign('sbu_id')->references('id')->on('sbu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hspk_sbu');
    }
}
