<?php

namespace App\Http\Controllers;

use DB;
use Redirect;
use App\Paket;
use App\Section;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function LihatPaket($id)
    {
        $data = [
            'title' => 'Paket Soal '.Section::find($id)->nama,
            'paket' => Paket::where('section_id', $id)->get(),
            'id'=> $id
        ];
        return view('paketsoal')->with(compact('data'));
    }
    public function TambahPaket($id)
    {
        $data = [
            'title' => 'Tambah Paket Soal '.Section::find($id)->nama,
            'id' => $id,
            'section' => Section::find($id)
        ];
        return view('tambahpaketsoal')->with(compact('data'));
    }

    public function SubmitTambahPaket(Request $request)
    {
        $validator  = $request->validate([
            'nama'      => 'required',
            'section_id' => 'required'
        ]);
        DB::BeginTransaction();
        try{
            $paket = New Paket;
            $paket->nama = $request->nama;
            $paket->keterangan = $request->keterangan;
            $paket->section_id = $request->section_id;
            $paket->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollback();
        }
        return redirect('paketsoal/'.$request->section_id)->with('pesan_sukses', 'Paket berhasil ditambah');
    }

    public function HapusPaket($id)
    {
        Paket::find($id)->delete();
        return Redirect::back()->with('pesan_sukses', 'Paket berhasil dihapus');
    }

}
