<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanBenarSalah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_benar_salah', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('jawaban');
    
            $table->integer('soal_id')->unsigned()->index()->nullable();
            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');

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
        Schema::dropIfExists('jawaban_benar_salah');
    }
}
