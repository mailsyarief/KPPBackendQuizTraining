<?php

namespace App\Http\Controllers;
use App\Section;
use App\Peserta;
use DB;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function LihatPeserta(){
        $data = [
            'title' => 'Peserta',
            'peserta' => Peserta::all()
        ];
        return view('peserta')->with(compact('data'));
    }

    public function DaftarPeserta(Request $request){
        $token = md5(uniqid($request->nrp, true));
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
    }
}
