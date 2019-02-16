<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\Soal;
use App\Paket;
use App\PilihanJawabanMencocokan;
use App\JawabanPilihanGanda;
use App\JawabanMencocokan;
use App\JawabanBenarSalah;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function RequestSoal(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $nomor = $peserta->soal_terakhir + 1;
        $soal = Soal::where('paket_id', $peserta->Paket->id)->where('nomor_soal', $nomor)->first();
        $message = array('soal' => $soal);

        if($soal->tipe_soal == 'PILIHANGANDA'){
            $pilihanganda = JawabanPilihanGanda::where('soal_id', $soal->id)->first();
            $message['jawaban'] = $pilihanganda;
        }
        else if($soal->tipe_soal == 'MENCOCOKAN'){
            $mencocokan = JawabanMencocokan::where('soal_id', $soal->id)->first();
            $pilihanjawaban = PilihanJawabanMencocokan::where('paket_id', $peserta->Paket->id)->get();
            $message['jawaban'] = $mencocokan;
            $message ['pilihanjawaban'] = $pilihanjawaban;
        }
        else if($soal->tipe_soal == 'BENARSALAH'){
            $benarsalah = JawabanBenarSalah::where('soal_id', $soal->id)->first();
            $message['jawaban'] = $benarsalah;
        }
        return response()->json(['error' => 0,'message' => $message], 200);
    }
}
