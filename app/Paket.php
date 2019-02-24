<?php

namespace App;

use App\Soal;
use App\Peserta;
use App\PilihanJawabanMencocokan;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    protected $fillable = ['nama','keterangan','section_id', 'jumlah_soal', 'jumlah_pilihan_ganda', 'jumlah_benar_salah', 'jumlah_mencocokan'];

    public function Peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function Soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function Section()
    {
        return $this->belongsTo(Paket::class);
    }

    public function PilihanJawabanMencocokan()
    {
        return $this->hasMany(PilihanJawabanMencocokan::class);
    }

    public function JawabanPesertaPilihanGanda()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_pilihan_ganda','paket_id', 'peserta_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }

    public function JawabanPesertaBenarSalah()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_benar_salah','paket_id', 'peserta_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }

    public function JawabanPesertaMencocokan()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_mencocokan','paket_id', 'peserta_id')
                    ->withPivot('jumlahBenar')
                    ->withTimeStamps();
    }
}
