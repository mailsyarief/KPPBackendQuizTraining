<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanPesertaMencocokan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_peserta_mencocokan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jawaban_peserta');

            $table->integer('jawaban_mencocokan_id')->unsigned()->index()->nullable();
            $table->foreign('jawaban_mencocokan_id')->references('id')->on('jawaban_mencocokan');

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
        Schema::dropIfExists('jawaban_peserta_mencocokan');
    }
}
