<?php

namespace App\Http\Controllers;
use DB;
use App\Peserta;
use App\Soal;
use App\Paket;
use App\PilihanJawabanMencocokan;
use App\JawabanPilihanGanda;
use App\JawabanMencocokan;
use App\JawabanBenarSalah;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function LihatPeserta()
    {
        $data = [
            'title' => 'Peserta',
            'peserta' => Peserta::all()
        ];
        return view('peserta')->with(compact('data'));
    }

    public function DetilPeserta($id)
    {
        $peserta = Peserta::find($id)->first();
        $data = [
            'title' => 'Detil Peserta ',
            'peserta' => $peserta,
            'pilihanganda' => Soal::where('paket_id', $peserta->paket_id)->where('tipe_soal', 'PILIHANGANDA')->get(),
            'soal' => Soal::all()
        ];
        //  dd($data['soal']->first()->JawabanPesertaPilihanGanda()->first()->pivot->soal_id);
        return view('detilpeserta')->with(compact('data'));
    }

    public function DeleteAkun($id)
    {
        
    }

    public function DaftarPeserta(Request $request)
    {
        $token = md5(uniqid(rand(), true));
        $section = Section::where('nama', $request->section)->first();
        if($section == NULL){
            return response()->json(['error' => 0,'message' => 'section tidak ditemukan'], 200);
        }
        DB::BeginTransaction();
        try{
            $peserta = New Peserta;
            $peserta->nama = $request->nama;
            $peserta->nrp = $request->nrp;
            $peserta->section = $request->section;
            $peserta->token = $token;
            $peserta->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json(['error' => 0,'message' => $token], 200);
    }

    public function CekPaketPeserta(Request $request)
    {
        $cekPaket = Peserta::where('token', $request->token)->first();
        if($cekPaket == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        if($cekPaket->soal_id == NULL){
            return response()->json(['error' => 0,'message' => 'soal belum tersedia'], 200);  
        }
        return response()->json(['error' => 0,'message' => 'soal sudah tersedia'], 200);    
    }

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
        
        if($request->jawaban != $request->jawaban_peserta){
            $isTrue = 0;
        }
        else{
            $isTrue = 1;
        }

        if($soal->tipe_soal == 'PILIHANGANDA'){
            $soal->JawabanPesertaPilihanGanda()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta, 'isTrue' => $isTrue]);
        }
        else if($soal->tipe_soal == 'MENCOCOKAN'){
            $soal->JawabanPesertaMencocokan()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta, 'isTrue' => $isTrue]);
        }
        else if($soal->tipe_soal == 'BENARSALAH'){
            $soal->JawabanPesertaBenarSalah()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta, 'isTrue' => $isTrue]);
        }
        $nomor = $peserta->soal_terakhir + 1;
        $peserta->update(['soal_terakhir' => $nomor]);
        return response()->json(['error' => 0,'message' => 'sukses input'], 200);
    }

    public function SelesaiUjian(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        // verifikasi sudah diisi semua jawaban atau belum
        // if($peserta->soal_terakhir != $peseta->Paket()->jumlah_soal){
        //     return response()->json(['error' => 1,'message' => 'soal belum dijawab semua'], 200);  
        // }
        
        //pilihan ganda
        $pid = $peserta->id;
        $jawabanPilganPeserta = $peserta->JawabanPilihanGanda()->foreignPivotKey('peserta_id', $peserta->id);
        dd($jawabanPilganPeserta);
        $kunciJawabanPilgan = JawabanPilihanGanda::where('soal_id', $jawabanPilganPeserta->soal_id)->orderBy('soal_id', 'DESC')->get();
        dd($jawabanPilganPeserta);
        // dd($kunciJawabanPilgan);
    }
}
