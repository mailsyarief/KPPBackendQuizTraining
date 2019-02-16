<?php

namespace App;

use App\Paket;
use App\JawabanPilihanGanda;
use App\JawabanMencocokan;
use App\JawabanBenarSalah;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = ['nama','nrp','nilai','token','isRemedial','nilaiRemedial','paket_id', 'section_id', 'soal_terakhir', 'nomor_soal'];

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function JawabanMencocokan()
    {
        return $this->belongsToMany(Soal::class ,'jawaban_peserta_mencocokan','peserta_id', 'soal_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }

    public function JawabanPilihanGanda()
    {
        return $this->belongsToMany(Soal::class ,'jawaban_peserta_pilihan_ganda','peserta_id', 'soal_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }

    public function JawabanBenarSalah()
    {
        return $this->belongsToMany(Soal::class ,'jawaban_peserta_benar_salah','peserta_id', 'soal_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }
}
