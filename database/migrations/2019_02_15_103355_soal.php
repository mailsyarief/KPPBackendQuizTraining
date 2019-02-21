<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Soal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomor_soal');
            $table->string('soal_gambar')->nullable();
            $table->string('soal');
            $table->string('tipe_soal');
            $table->integer('waktu')->default(3000);
            $table->boolean('showJawaban')->default(1);

            $table->integer('paket_id')->unsigned()->index()->nullable();
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
        
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
        Schema::dropIfExists('soal');
    }
}
