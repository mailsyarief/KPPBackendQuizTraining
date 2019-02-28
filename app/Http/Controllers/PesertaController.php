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

    public function Mulai()
    {
        Peserta::where('isStart', 0)
                ->where('isFinished', 0)
                ->where('paket_id', '!=', NULL)
                ->update(['isStart' => 1]);
        return Redirect('peserta')->with('pesan_sukses', 'Memulai ujian untuk peserta');
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
    public function PilihKategoriPeserta()
    {
        $data = [
            'title' => 'Kategori Peserta'
        ];
        return view('pilihkategoripaket')->with(compact('data'));
    }

    public function BelumUjian()
    {
        $peserta = Peserta::where('isStart', 0)->where('isFinished', 0)->get();
        $data = [
            'title' => 'Peserta yang belum mulai ujian',
            'peserta' => $peserta,
            'isCetak' => 0,
            'isStart' => 1
        ];
        return view('peserta')->with(compact('data'));
    }
    public function SedangUjian()
    {
        $peserta = Peserta::where('isStart', 1)->where('isFinished', 0)->get();
        $data = [
            'title' => 'Peserta yang sedang ujian',
            'peserta' => $peserta,
            'isCetak' => 0,
            'isStart' => 0
        ];
        return view('peserta')->with(compact('data'));
    }
    public function KelarUjian()
    {
        $peserta = Peserta::where('isStart', 1)->where('isFinished', 1)->get();
        $data = [
            'title' => 'Peserta yang sudah selesai ujian',
            'peserta' => $peserta,
            'isCetak' => 1,
            'isStart' => 0
        ];
        return view('peserta')->with(compact('data'));
    }
    public function DaftarPeserta(Request $request)
    {
        $token = md5(uniqid(rand(), true));
        $section = Section::where('nama', $request->section)->first();
        if($section == NULL){
            return response()->json(['error' => 0,'message' => 'section tidak ditemukan'], 200);
        }
        $getIDSection = Section::where('nama', $request->section)->first()->id;
        DB::BeginTransaction();
        try{
            $peserta = New Peserta;
            $peserta->nama = $request->nama;
            $peserta->nrp = $request->nrp;
            $peserta->section_id = $getIDSection;
            $peserta->token = $token;
            $peserta->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json(['error' => 0,'message' => $token], 200);
    }

    public function GetSectionPeserta()
    {
        $section = Section::all()->pluck('nama')->toArray();
        return response()->json(['error' => 0,'message' => array('section' => $section)], 200);
    }

    public function CekKoneksi()
    {
        return response()->json(['error' => 0,'message' => '-'], 200);  
    }

    public function CekPaketPeserta(Request $request)
    {
        $cekPaket = Peserta::where('token', $request->token)->first();
        if($cekPaket == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        if($cekPaket->isStart == 0 || $cekPaket->paket_id== NULL){
            return response()->json(['error' => -1,'message' => '-'], 200);  
        }
        return response()->json(['error' => 0,'message' => '-'], 200);    
    }

    public function RequestSoal(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->where('isStart', 1)->first();
        $paket = Paket::find($peserta->paket_id)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        if($request->tipe_soal == 'PILIHANGANDA'){
            $nomor = $peserta->soal_terakhir;
            $soal = Soal::where('paket_id', $peserta->Paket->id)
                        ->where('nomor_soal', $nomor)
                        ->where('tipe_soal', $request->tipe_soal)
                        ->first();
            if($soal == NULL){
                $error = 1;
                $message = [
                    'kode_soal' => '-',
                    'gambar_soal' => '-',
                    'isi_soal' => '-',
                    'waktu' => 0,
                    'nomor' => 0,
                    'showJawaban' => 0,
                    'pilihanA' => '-',
                    'pilihanB' => '-',
                    'pilihanC' => '-',
                    'pilihanD' => '-',
                    'jawaban' => '-'
                ];
                return response()->json(['error' => $error,'message' => $message], 200);
            }
            else{
                if($soal->gambar_soal == NULL){
                    $gambarSoal = '-';
                }
                else{
                    $gambarSoal = $soal->gambar_soal;
                }
                $pilihanganda = JawabanPilihanGanda::where('soal_id', $soal->id)->first();
                $error = 0;
                $message = [
                    'kode_soal' => $soal->id,
                    'gambar_soal' => $gambarSoal,
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
                return response()->json(['error' => $error,'message' => $message], 200);
            }
        }
        else if($request->tipe_soal == 'MENCOCOKAN'){
            $cekSoal = Soal::where('paket_id', $peserta->paket_id)
                    ->where('tipe_soal', $request->tipe_soal)
                    ->where('nomor_soal', $peserta->soal_terakhir)
                    ->first();
            $soal = Soal::where('paket_id', $peserta->paket_id)
                    ->where('tipe_soal', $request->tipe_soal)
                    ->get();
            if($cekSoal == NULL){
                $error = 2;
                $message = [
                    'kode_soal' => '-',
                    'waktu' => 0,
                    'isi_soal' => [],
                    'opsi_jawaban' => [],
                    'kunci_jawaban' => [],
                ];
                return response()->json(['error' => $error,'message' => $message], 200);
            }
            else{
                foreach($soal as $soal){
                    $isi_soal[] = array('id_pertanyaan' => $soal->id ,'isi_pertanyaan' => $soal->soal);
                }
                $mencocokan = JawabanMencocokan::whereIn('soal_id', $soal->pluck('id')->toArray())->orderBy('soal_id', 'ASC')->get();
                foreach($mencocokan as $mencocokan){
                    $kunci_jawaban_mencocokan[] = $mencocokan->PilihanJawabanMencocokan->pilihan_jawaban;
                }
                $opsi_jawaban = PilihanJawabanMencocokan::where('paket_id', $peserta->Paket->id)->get()->pluck('pilihan_jawaban')->toArray();
                $error = 1;
                $message = [
                    'kode_soal' => $request->tipe_soal,
                    'waktu' => ($soal->first()->waktu)*$paket->jumlah_mencocokan,
                    'isi_soal' => $isi_soal,
                    'opsi_jawaban' => $opsi_jawaban,
                    'kunci_jawaban' => $kunci_jawaban_mencocokan,
                ];
                return response()->json(['error' => $error,'message' => $message], 200);
            }
        }
        else if($request->tipe_soal == 'BENARSALAH'){
            $soal = Soal::where('paket_id', $peserta->Paket->id)
                        ->where('nomor_soal', $peserta->soal_terakhir)
                        ->where('tipe_soal', $request->tipe_soal)
                        ->first();
            if($soal == NULL){
                $error = 3;
                $message = [
                    'kode_soal' => '-',
                    'isi_soal' => '-',
                    'waktu' => 0,
                    'nomor' => '-',
                    'showJawaban' => 0,
                    'jawaban' => 0
                ];
                return response()->json(['error' => $error,'message' => $message], 200);
            }
            else{
                $error = 2;
                $benarsalah = JawabanBenarSalah::where('soal_id', $soal->id)->first();
                $message = [
                    'kode_soal' => $soal->id,
                    'isi_soal' => $soal->soal,
                    'waktu' => $soal->waktu,
                    'nomor' => $soal->nomor_soal,
                    'showJawaban' => $soal->showJawaban,
                    'jawaban' =>$benarsalah->jawaban
                ];
                return response()->json(['error' => $error,'message' => $message], 200);
            }
        }
        else if($request->tipe_soal == 'ESSAY'){
            $soal = Soal::where('paket_id', $peserta->Paket->id)
            ->where('nomor_soal', $peserta->soal_terakhir)
            ->where('tipe_soal', $request->tipe_soal)
            ->first();
        }
    }

    public function SubmitJawaban(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id);

        if($paket->JawabanPesertaPilihanGanda()->where('peserta_id', $peserta->id)->first() == NULL){
            $paket->JawabanPesertaPilihanGanda()->attach($peserta->id,['jumlahBenar' => 0]); 
        }
        if($paket->JawabanPesertaMencocokan()->where('peserta_id', $peserta->id)->first() == NULL){
            $paket->JawabanPesertaMencocokan()->attach($peserta->id,['jumlahBenar' => 0]); 
        } 
        if($paket->JawabanPesertaBenarSalah()->where('peserta_id', $peserta->id)->first() == NULL){
            $paket->JawabanPesertaBenarSalah()->attach($peserta->id,['jumlahBenar' => 0]); 
        }

        if($request->tipe_soal == 'PILIHANGANDA' && $request->nilai > 0){
            $temp = $paket->JawabanPesertaPilihanGanda()->where('peserta_id', $peserta->id)->first()->pivot->jumlahBenar;
            $paket->JawabanPesertaPilihanGanda()->where('peserta_id', $peserta->id)->detach();
            $paket->JawabanPesertaPilihanGanda()->attach($peserta->id,['jumlahBenar' => $temp+1]); 
            $nomor = $peserta->soal_terakhir + 1;
        }
        else{
            $nomor = $peserta->soal_terakhir + 1;
        }

        if($request->tipe_soal == 'MENCOCOKAN' && $request->nilai > 0){           
            $paket->JawabanPesertaMencocokan()->attach($peserta->id,['jumlahBenar' => $request->nilai]);
            $nomor = $peserta->soal_terakhir + $paket->jumlah_mencocokan;
        }
        else{
            $nomor = $peserta->soal_terakhir + $paket->jumlah_mencocokan;
        }

        if($request->tipe_soal == 'BENARSALAH' && $request->nilai > 0){
            $temp = $paket->JawabanPesertaBenarSalah()->where('peserta_id', $peserta->id)->first()->pivot->jumlahBenar;
            $paket->JawabanPesertaBenarSalah()->where('peserta_id', $peserta->id)->detach();
            $paket->JawabanPesertaBenarSalah()->attach($peserta->id,['jumlahBenar' => $temp+1]); 
            $nomor = $peserta->soal_terakhir + 1;
        }
        else{
            $nomor = $peserta->soal_terakhir + 1;
        }
        $peserta->update(['soal_terakhir' => $nomor]);
        return response()->json(['error' => 0,'message' => 'sukses input'], 200);
    }

    public function SelesaiUjian(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id);
        $jumlahSoal = $paket->jumlah_soal;
        $benarPilgan = $paket->JawabanPesertaPilihanGanda()->where('peserta_id', $peserta->id)->first()->pivot->jumlahBenar;
        $jumlahPilgan = $paket->jumlah_pilihan_ganda;
        $nilaiPilgan = ($benarPilgan / $jumlahPilgan) * 100;
        $benarMencocokan = $paket->JawabanPesertaMencocokan()->where('peserta_id', $peserta->id)->first()->pivot->jumlahBenar;
        $jumlahMencocokan = $paket->jumlah_mencocokan;
        $nilaiMencocokan = ($benarMencocokan / $jumlahMencocokan) * 100;
        $benarBenarSalah = $paket->JawabanPesertaBenarSalah()->where('peserta_id', $peserta->id)->first()->pivot->jumlahBenar;
        $jumlahBenarSalah = $paket->jumlah_benar_salah;
        $nilaiBenarSalah = ($benarBenarSalah / $jumlahBenarSalah) * 100;
        $nilaiAkhir = (($benarPilgan + $benarMencocokan + $benarBenarSalah) / $jumlahSoal) * 100;
        $message = [
            'nilai_pilgan' => round($nilaiPilgan),
            'nilai_mencocokan' => round($nilaiMencocokan),
            'nilai_benar_salah' => round($nilaiBenarSalah),
            'nilai_akhir' => round($nilaiAkhir)
        ];
        if($peserta->isRemedial == 1){
            $peserta->update(['isFinished' => 1, 'nilaiRemedial' => $nilaiAkhir]);
        }
        else{
            $peserta->update(['isFinished' => 1, 'nilai' => $nilaiAkhir]);            
        }
        return response()->json(['error' => 3,'message' => $message], 200);
    }

    public function Remedial(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id);
        $paket->JawabanPesertaBenarSalah()->where('peserta_id', $peserta->id)->detach();
        $paket->JawabanPesertaMencocokan()->where('peserta_id', $peserta->id)->detach();
        $paket->JawabanPesertaPilihanGanda()->where('peserta_id', $peserta->id)->detach();
        $peserta->update(['soal_terakhir' => 1, 'isRemedial' => 1, 'isFinished' => 0]);
        return response()->json(['error' => 1,'message' => 'sukses'], 200);  
    }

    public function PembahasanPilihanGanda(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id)->first();
        $idPaket = $peserta->paket_id;
        $soal = Soal::where('paket_id', $peserta->paket_id)
                ->where('tipe_soal', 'PILIHANGANDA')
                ->orderBy('id', 'ASC')
                ->get();
        $jawaban = JawabanPilihanGanda::whereIn('soal_id', function($query) use($idPaket){
            $query->select('id')
                ->from('soal')
                ->where('paket_id', $idPaket)
                ->where('tipe_soal', 'PILIHANGANDA')
                ->orderBy('id', 'ASC');
        })->orderBy('soal_id', 'ASC')->get();
        foreach($soal as $soal){
            $isi_soal[] = [
                'id_soal' => $soal->id,
                'soal' => $soal->soal
            ];
        }
        foreach($jawaban as $jawaban){
            $isi_jawaban[] = [
                'id_soal' => $jawaban->soal_id,
                'pilihanA' => $jawaban->pilihan_a,
                'pilihanB' => $jawaban->pilihan_b,
                'pilihanC' => $jawaban->pilihan_c,
                'pilihanD' => $jawaban->pilihan_d,
                'jawaban' => $jawaban->jawaban
            ];
        }
        $message = [
            'soal' => $isi_soal,
            'jawaban' => $isi_jawaban
        ];
        return response()->json(['error' => 1,'message' => $message], 200);  
    }

    public function PembahasanMencocokan(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id)->first();
        $idPaket = $peserta->paket_id;
        $soal = Soal::where('paket_id', $peserta->paket_id)
                ->where('tipe_soal', 'MENCOCOKAN')
                ->orderBy('id', 'ASC')
                ->get();
        $jawaban = JawabanMencocokan::whereIn('soal_id', function($query) use($idPaket){
            $query->select('id')
                ->from('soal')
                ->where('paket_id', $idPaket)
                ->where('tipe_soal', 'MENCOCOKAN')
                ->orderBy('id', 'ASC');
        })->orderBy('soal_id', 'ASC')->get();
        foreach($soal as $soal){
            $isi_soal[] = [
                'id_soal' => $soal->id,
                'soal' => $soal->soal,
            ];
        }
        foreach($jawaban as $jawaban){
            $isi_jawaban[] = [
                'id_soal' => $jawaban->soal_id,
                'jawaban' => $jawaban->PilihanJawabanMencocokan->pilihan_jawaban
            ];
        }
        $message = [
            'id' => $paket->id,
            'tipe' => 'MENCOCOKAN',
            'paket' => $paket->nama,
            'soal' => $isi_soal,
            'jawaban' => $isi_jawaban
        ];
        return response()->json(['error' => 1,'message' => $message], 200);  
    }

    public function PembahasanBenarSalah(Request $request)
    {
        $peserta = Peserta::where('token', $request->token)->first();
        if($peserta == NULL){
            return response()->json(['error' => 1,'message' => 'token salah'], 200);  
        }
        $paket = Paket::find($peserta->paket_id)->first();
        $idPaket = $peserta->paket_id;
        $soal = Soal::where('paket_id', $peserta->paket_id)
                ->where('tipe_soal', 'BENARSALAH')
                ->orderBy('id', 'ASC')
                ->get();
        $jawaban = JawabanBenarSalah::whereIn('soal_id', function($query) use($idPaket){
            $query->select('id')
                ->from('soal')
                ->where('paket_id', $idPaket)
                ->where('tipe_soal', 'BENARSALAH')
                ->orderBy('id', 'ASC');
        })->orderBy('soal_id', 'ASC')->get();
        foreach($soal as $soal){
            $isi_soal[] = [
                'id_soal' => $soal->id,
                'soal' => $soal->soal
            ];
        }
        foreach($jawaban as $jawaban){
            $isi_jawaban[] = [
                'id_soal' => $jawaban->soal_id,
                'jawaban' => $jawaban->jawaban
            ];
        }
        $message = [
            'soal' => $isi_soal,
            'jawaban' => $isi_jawaban
        ];
        return response()->json(['error' => 1,'message' => $message], 200);      
    }

}
