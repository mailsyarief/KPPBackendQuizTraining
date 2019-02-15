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
            $table->boolean('isRemedial')->default(0);
            $table->integer('nilaiRemedial')->nullable();
            $table->timestamps();

            $table->integer('paket_id')->unsigned()->index()->nullable();
            $table->foreign('paket_id')->references('id')->on('paket');
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
