<?php

use App\Paket;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paket = new Paket;
        $paket->nama = 'PK PC 200';
        $paket->keterangan = '-';
        $paket->durasi_per_soal = 2;
        $paket->section_id = 2; //track
        $paket->jumlah_soal = 20;
        $paket->save();

        $paket = new Paket;
        $paket->nama = 'PK PC 400';
        $paket->keterangan = '-';
        $paket->durasi_per_soal = 2;
        $paket->section_id = 2; //track
        $paket->save();

        $paket = new Paket;
        $paket->nama = 'PM SCANIA';
        $paket->keterangan = '-';
        $paket->durasi_per_soal = 2;
        $paket->section_id = 3; //sse-hauling
        $paket->save();
    }
}
