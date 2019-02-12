<?php

namespace App\Http\Controllers;
use App\Peserta;
use DB;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function LihatPeserta(){
        return response()->json(['error' => 0,'message' => Peserta::all() ], 200);
    }

    public function DaftarPeserta(Request $request){
        $token = md5(uniqid($request->nrp, true));
        DB::BeginTransaction();
        try{
            $peserta = New Peserta;
            $peserta->nama = $request->nama;
            $peserta->nrp = $request->nrp;
            $peserta->section = $request->section;
            $peserta->training = $request->training;
            $peserta->token = $token;
            $peserta->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json(['error' => 0,'message' => $token], 200);
    }
}
