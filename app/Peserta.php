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
    protected $fillable = ['nama','nrp','nilai','token','isRemedial','nilaiRemedial','paket_id', 'section_id'];

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function JawabanMencocokan()
    {
        return $this->belongsToMany(JawabanMencocokan::class ,'jawaban_peserta_mencocokan','jawaban_mencocokan_id', 'peserta_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }

    public function JawabanPilihanGanda()
    {
        return $this->belongsToMany(JawabanPilihanGanda::class ,'jawaban_peserta_pilihan_ganda','jawaban_pilihan_ganda_id', 'peserta_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }

    public function JawabanBenarSalah()
    {
        return $this->belongsToMany(JawabanBenarSalah::class ,'jawaban_peserta_benar_salah','jawaban_benar_salah_id', 'peserta_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }
}
