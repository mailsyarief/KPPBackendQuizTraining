<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Peserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nrp');
            $table->integer('nilai')->nullable();
            $table->string('token')->nullable();
            $table->integer('soal_terakhir')->nullable();
            $table->timestamps();

            $table->unsignedInteger('section_id');
            $table->foreign('section_id')->references('id')->on('section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peserta');
    }
}
