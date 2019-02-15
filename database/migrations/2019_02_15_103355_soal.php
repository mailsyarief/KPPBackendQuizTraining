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
            $table->string('soal_gambar')->nullable();
            $table->string('soal');
            $table->string('tipe soal');

            $table->integer('paket_id')->unsigned()->index()->nullable();
            $table->foreign('paket_id')->references('id')->on('paket');
    
            $table->integer('section_id')->unsigned()->index()->nullable();
            $table->foreign('section_id')->references('id')->on('section');
            
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
