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
        $nomor = $peserta->soal_terakhir;
        $paket = Paket::find($peserta->Paket->id)->first();
        $soal = Soal::where('paket_id', $peserta->Paket->id)->where('nomor_soal', $nomor)->first();
        $message = array('paket' => $paket ,'soal' => $soal);

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

    public function SubmitJawaban(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $soal = Soal::where('paket_id', $peserta->paket_id)->where('nomor_soal', $peserta->soal_terakhir)->first();
        if($soal->tipe_soal == 'PILIHANGANDA'){
            $soal->JawabanPesertaPilihanGanda()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta]);
        }
        else if($soal->tipe_soal == 'MENCOCOKAN'){
            $soal->JawabanPesertaMencocokan()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta]);
        }
        else if($soal->tipe_soal == 'BENARSALAH'){
            $soal->JawabanPesertaBenarSalah()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta]);
        }
        $nomor = $peserta->soal_terakhir + 1;
        $peserta->update(['soal_terakhir' => $nomor]);
        return response()->json(['error' => 0,'message' => 'sukses input'], 200);
    }
}
