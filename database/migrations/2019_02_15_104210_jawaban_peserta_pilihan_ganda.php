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
            $table->integer('jumlahBenar')->default(0);

            $table->integer('paket_id')->unsigned()->nullable();
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');

            $table->integer('peserta_id')->unsigned()->nullable();
            $table->foreign('peserta_id')->references('id')->on('peserta')->onDelete('cascade');

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
