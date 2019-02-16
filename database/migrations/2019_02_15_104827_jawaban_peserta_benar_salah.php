<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanPesertaBenarSalah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_peserta_benar_salah', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('jawaban_peserta');

            $table->integer('soal_id')->unsigned()->index()->nullable();
            $table->foreign('soal_id')->references('id')->on('soal');

            $table->integer('peserta_id')->unsigned()->index()->nullable();
            $table->foreign('peserta_id')->references('id')->on('peserta');
            
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
        Schema::dropIfExists('jawaban_peserta_benar_salah');
    }
}
