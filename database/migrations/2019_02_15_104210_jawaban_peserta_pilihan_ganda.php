<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanPesertaPilihanGanda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_peserta_pilihan_ganda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jawaban_peserta');

            $table->integer('jawaban_pilihan_ganda_id')->unsigned()->index()->nullable();
            $table->foreign('jawaban_pilihan_ganda_id')->references('id')->on('jawaban_pilihan_ganda');

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
        Schema::dropIfExists('jawaban_peserta_pilihan_ganda');
    }
}