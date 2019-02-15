<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JawabanPilihanGanda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_pilihan_ganda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('jawaban');

            $table->integer('soal_id')->unsigned()->index()->nullable();
            $table->foreign('soal_id')->references('id')->on('soal');

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
        Schema::dropIfExists('jawaban_pilihan_ganda');
    }
}
