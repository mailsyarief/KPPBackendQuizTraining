<?php

namespace App\Http\Controllers;
use DB;
use Redirect;
use App\Peserta;
use App\Soal;
use App\Paket;
use App\Section;
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
    
    public function TentukanPaketPeserta($id)
    {
        $peserta = Peserta::find($id);
        $data = [
            'title' => 'Tentukan paket soal untuk peserta '.$peserta->nama,
            'peserta' => $peserta,
            'paket' => Paket::where('section_id', $peserta->section_id)->get()
        ];
        return view('pilihpaketpeserta')->with(compact('data'));
    }

    public function PilihPaketPeserta($idPeserta,$idPaket)
    {
        $paket = Paket::find($idPaket);
        $peserta = Peserta::find($idPeserta);
        $peserta->paket_id = $paket->id;
        $peserta->save();
        return Redirect('peserta')->with('pesan_sukses', 'Paket soal berhasil dipilih untuk '.$peserta->nama);
    }
    
    public function DetilPeserta($id)
    {
        $peserta = Peserta::find($id)->first();
        $data = [
            'title' => 'Detil Peserta ',
            'peserta' => $peserta,
            'pilihanganda' => Soal::where('paket_id', $peserta->paket_id)->where('tipe_soal', 'PILIHANGANDA')->get(),
            'soal' => Soal::all(),
            'benarsalah' => Soal::where('paket_id', $peserta->paket_id)->where('tipe_soal', 'BENARSALAH')->get(),
            'mencocokan' =>Soal::where('paket_id', $peserta->paket_id)->where('tipe_soal', 'MENCOCOKAN')->get()
        ];
        return view('detilpeserta')->with(compact('data'));
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

    public function GetSectionPeserta(Request $request)
    {
        $section = Section::all()->pluck('nama')->toArray();
        return response()->json(['error' => 0,'message' => array('section' => $section)], 200);
    }

    public function CekKoneksi(Request $request)
    {
        return response()->json(['error' => 0,'message' => array()], 200);  
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
        if($request->tipe_soal == 'PILIHANGANDA'){
            $nomor = $peserta->soal_terakhir;
            $soal = Soal::where('paket_id', $peserta->Paket->id)->where('nomor_soal', $nomor)->first();
            $pilihanganda = JawabanPilihanGanda::where('soal_id', $soal->id)->first();
            $jumlahpilgan = Paket::find($peserta->Paket->id)->first()->jumlah_pilihan_ganda;
            if($nomor < $jumlahpilgan){
                $error = 0;
            }
            else if($nomor == $jumlahpilgan){
                $error = 3;
            }
            $message = [
                'kode_soal' => $soal->id,
                'isi_soal' => $soal->soal,
                'waktu' => $soal->waktu,
                'nomor' => $soal->nomor_soal,
                'showJawaban' => $soal->showJawaban,
                'pilihanA' => $pilihanganda->pilihan_a,
                'pilihanB' => $pilihanganda->pilihan_b,
                'pilihanC' => $pilihanganda->pilihan_c,
                'pilihanD' => $pilihanganda->pilihan_d,
                'jawaban' => $pilihanganda->jawaban
            ];
        }
        else if($request->tipe_soal == 'MENCOCOKAN'){
            $soal = Soal::where('paket_id', $peserta->Paket->id)->where('tipe_soal', $request->tipe_soal)->get();
            foreach($soal as $soal){
                $isi_soal[] = array('id_pertanyaan' => $soal->id ,'isi_pertanyaan' => $soal->soal);
            }
            $mencocokan = JawabanMencocokan::whereIn('soal_id', $soal->pluck('id')->toArray())->orderBy('soal_id', 'ASC')->get();
            foreach($mencocokan as $mencocokan){
                $kunci_jawaban_mencocokan[] = $mencocokan->PilihanJawabanMencocokan->pilihan_jawaban;
            }
            $opsi_jawaban = PilihanJawabanMencocokan::where('paket_id', $peserta->Paket->id)->get()->pluck('pilihan_jawaban')->toArray();
            $message = [
                'kode_soal' => $request->tipe_soal,
                'waktu' => $soal->first()->waktu,
                'isi_soal' => $isi_soal,
                'opsi_jawaban' => $opsi_jawaban,
                'kunci_jawaban' => $kunci_jawaban_mencocokan,
            ];
            $error = 0;
        }
        else if($request->tipe_soal == 'BENARSALAH'){
            $nomor = $peserta->soal_terakhir;
            $jumlahbenarsalah = Paket::find($peserta->Paket->id)->first();
            $cekbenarsalah = $nomor - $jumlahbenarsalah->jumlah_pilihan_ganda - $jumlahbenarsalah->jumlah_mencocokan;
            $soal = Soal::where('paket_id', $peserta->Paket->id)->where('nomor_soal', $nomor)->first();
            $benarsalah = JawabanBenarSalah::where('soal_id', $soal->id)->first();
            if($cekbenarsalah == $jumlahbenarsalah->jumlah_benar_salah){
                $error = 3;
            }
            else{
                $error = 0;
            }
            $message = [
                'kode_soal' => $soal->id,
                'isi_soal' => $soal->soal,
                'waktu' => $soal->waktu,
                'nomor' => $soal->nomor_soal,
                'showJawaban' => $soal->showJawaban,
                'jawaban' =>$benarsalah->jawaban
            ];
        }
        return response()->json(['error' => $error,'message' => $message], 200);
    }

    public function SubmitJawaban(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        $soal = Soal::find($peserta->Paket->id)->where('nomor_soal', $peserta->soal_terakhir)->where('TIPE_SOAL', $request->tipe_soal)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        if($request->jawaban == $request->jawaban_peserta){
            $isTrue = 1;
        }
        else{
            $isTrue = 0;
        }
        if($request->tipe_soal == 'PILIHANGANDA'){
            $soal->JawabanPesertaPilihanGanda()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta, 'isTrue' => $isTrue]);
        }
        else if($request->tipe_soal == 'MENCOCOKAN'){
            $soal->JawabanPesertaMencocokan()->attach($peserta->id,['jawaban_peserta' => $request->jawaban_peserta, 'isTrue' => $isTrue]);
        }
        else if($request->tipe_soal == 'BENARSALAH'){
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
        $pid = $peserta->id;
        $jawabanPilganPeserta = $peserta->JawabanPilihanGanda()->foreignPivotKey('peserta_id', $peserta->id);
        $kunciJawabanPilgan = JawabanPilihanGanda::where('soal_id', $jawabanPilganPeserta->soal_id)->orderBy('soal_id', 'DESC')->get();
    }

    public function Remedial(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $peserta->update(['soal_terakhir' => 1]);
        $peserta->JawabanPesertaPilihanGanda()->detach();
        $peserta->JawabanPesertaMencocokan()->detach();
        $peserta->JawabanPesertaBenarSalah()->detach();
        return response()->json(['error' => 1,'message' => 'sukses'], 200);  
    }
}
