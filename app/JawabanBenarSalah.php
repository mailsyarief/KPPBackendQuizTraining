<?php

namespace App;

use App\Soal;
use App\Peserta;
use Illuminate\Database\Eloquent\Model;

class JawabanBenarSalah extends Model
{
    protected $table = 'jawaban_benar_salah';
    protected $fillable = ['jawaban', 'soal_id'];

    public function Soal()
    {
        return $this->belongsTo(Soal::class);
    }    
}
