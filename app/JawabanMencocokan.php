<?php

namespace App;

use App\Peserta;
use App\PilihanJawabanMencocokan;
use App\Soal;
use Illuminate\Database\Eloquent\Model;

class JawabanMencocokan extends Model
{
    protected $table = 'jawaban_mencocokan';
    protected $fillable = ['jawaban', 'soal_id', 'pilihan_jawaban_mencocokan_id'];

    public function Soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function PilihanJawabanMencocokan()
    {
        return $this->belongsTo(PilihanJawabanMencocokan::class);
    }

    public function Peserta()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_mencocokan','jawaban_mencocokan_id', 'peserta_id')
                    ->withPivot('jawaban_peserta')
                    ->withTimeStamps();
    }
}
