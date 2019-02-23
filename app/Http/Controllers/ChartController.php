<?php

namespace App\Http\Controllers;

use App\Peserta;
use App\Paket;
use App\Section;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function PilihSection()
    {
        $data = [
            'title' => 'Pilih Section',
            'section' => Section::all()
        ];
        return view('pilihcharts')->with(compact('data'));
    }

    public function LihatChartPeserta($id)
    {
        $peserta = Peserta::where('paket_id', function($q) use ($id){
            $q->select('id')->from('Paket')->where('section_id', $id);
        })->get();

        $data = [
            'title' => 'Charts section '.Section::find($id)->nama,
            'peserta' => $peserta
        ];

        return view('charts')->with(compact('data'));
    }
}
