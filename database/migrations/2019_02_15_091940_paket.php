<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Paket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('durasi_per_soal');
            $table->integer('section_id')->unsigned()->index()->nullable();
            $table->foreign('section_id')->references('id')->on('section');
    
            $table->timestamps();

            $table->integer('jumlah_soal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket');
    }
}
