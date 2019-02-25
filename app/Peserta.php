<?php

namespace App;

use App\Section;
use App\Soal;
use App\Paket;
use App\JawabanPilihanGanda;
use App\JawabanMencocokan;
use App\JawabanBenarSalah;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = ['nama','nrp','nilai','token','isStart','isFinished', 'isRemedial','nilaiRemedial','paket_id', 'section_id', 'soal_terakhir', 'nomor_soal'];

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function Section()
    {
        return $this->belongsTo(Section::class);
    }

    public function JawabanPesertaMencocokan()
    {
        return $this->belongsToMany(Paket::class ,'jawaban_peserta_mencocokan','peserta_id', 'soal_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }

    public function JawabanPesertaPilihanGanda()
    {
        return $this->belongsToMany(Paket::class ,'jawaban_peserta_pilihan_ganda','peserta_id', 'soal_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }

    public function JawabanPesertaBenarSalah()
    {
        return $this->belongsToMany(Paket::class ,'jawaban_peserta_benar_salah','peserta_id', 'soal_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }
}
