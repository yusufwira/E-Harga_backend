<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsbHspkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asb_hspk', function (Blueprint $table) {
            $table->integer('asb_id')->unsigned();
            $table->foreign('asb_id')->references('id')->on('asb');
            $table->integer('hspk_id')->unsigned();
            $table->foreign('hspk_id')->references('id')->on('hspk');
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
        Schema::dropIfExists('asb_hspk');
    }
}
