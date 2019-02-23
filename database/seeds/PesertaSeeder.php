<?php

use App\Peserta;
use Illuminate\Database\Seeder;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peserta = new Peserta;
        $peserta->nama = 'Hilmi Raditya';
        $peserta->nrp = '12345678';
        $peserta->paket_id = 1;
        // $peserta->section = 'track';
        $peserta->token = 'e4237eac89c0ebfd812e9155cc3c346e';
        $peserta->save();
    }
}
