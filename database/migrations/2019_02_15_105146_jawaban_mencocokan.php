<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanMencocokan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_mencocokan', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pilihan_jawaban_mencocokan_id')->unsigned()->index()->nullable();
            $table->foreign('pilihan_jawaban_mencocokan_id')->references('id')->on('pilihan_jawaban_mencocokan')->onDelete('cascade');

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
        Schema::dropIfExists('jawaban_mencocokan');
    }
}
