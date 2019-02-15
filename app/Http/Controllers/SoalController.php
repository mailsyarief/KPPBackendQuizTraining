<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\Soal;
use App\Paket;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function Soal(Request $request)
    {
        //contoh
        // $pengiriman = DataPaket::whereIn('no_resi', function($query) use($id_kurir){
        //     $query->select('no_resi')->from('distribusi_dummy')->where('status','DELIVERED')->where('id_kurir', $id_kurir);
        // })->orderBy('waktu_penerima','desc')->get();
        $peserta = Peserta::where('token', $request->token)->first()->Paket->id;
        $soal = Soal::where('paket_id', $peserta)->get();
        return response()->json(['error' => 0,'message' => $soal], 200);
    }
}
