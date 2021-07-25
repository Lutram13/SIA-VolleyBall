<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('namaPelatih_id');
            $table->foreign('namaPelatih_id')->references('id')->on('pelatihs');

            $table->integer('kelompokUsia');
            $table->string('tempatLatihan'); 
            $table->string('hariLatihan'); 
            $table->time('jamLatihan', $precision = 0);
            
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
        Schema::dropIfExists('jadwals');
    }
}
