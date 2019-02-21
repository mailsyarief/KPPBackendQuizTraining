<?php

namespace App;

use App\Paket;
use App\JawabanMencocokan;
use App\JawabanPilihanGanda;
use App\JawabanBenarSalah;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $fillable = ['soal_gambar','soal','tipe_soal','paket_id', 'nomor_soal'];

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function JawabanMencocokan()
    {
        return $this->hasMany(JawabanMencocokan::class);
    }

    public function JawabanPilihanGanda()
    {
        return $this->hasMany(JawabanPilihanGanda::class);
    }

    public function JawabanBenarSalah()
    {
        return $this->hasMany(JawabanBenarSalah::class);
    }

    public function JawabanPesertaPilihanGanda()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_pilihan_ganda','peserta_id', 'soal_id')
                    ->withPivot('jawaban_peserta', 'isTrue')
                    ->withTimeStamps();
    }

    public function JawabanPesertaBenarSalah()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_benar_salah', 'peserta_id','soal_id')
                    ->withPivot('jawaban_peserta', 'isTrue')
                    ->withTimeStamps();
    }

    public function JawabanPesertaMencocokan()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_mencocokan', 'peserta_id','soal_id')
                    ->withPivot('jawaban_peserta', 'isTrue')
                    ->withTimeStamps();
    }
}
