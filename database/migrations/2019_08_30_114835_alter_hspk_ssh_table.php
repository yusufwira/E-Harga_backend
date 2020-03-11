<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHspkSshTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('hspk_ssh', function (Blueprint $table) {
            $table->string('jumlah')->nullable();           
           
        });

          Schema::table('hspk_sbu', function (Blueprint $table) {
            $table->string('jumlah')->nullable();           
           
        });

           Schema::table('hspk', function (Blueprint $table) {
            $table->string('profit')->nullable();           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
