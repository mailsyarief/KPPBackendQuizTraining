<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabanBenarSalah extends Model
{
    protected $table = 'jawaban_benar_salah';
    protected $fillable = ['jawaban', 'soal_id'];

    public function Peserta()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_benar_salah','jawaban_benar_salah_id', 'peserta_id')->withPivot('jawaban_peserta')->withTimeStamps();
    }
}
