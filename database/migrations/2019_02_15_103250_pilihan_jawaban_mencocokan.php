<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PilihanJawabanMencocokan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilihan_jawaban_mencocokan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pilihan_jawaban');
            $table->timestamps();

            $table->integer('paket_id')->unsigned()->index()->nullable();
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pilihan_jawaban_mencocokan');
    }
}
