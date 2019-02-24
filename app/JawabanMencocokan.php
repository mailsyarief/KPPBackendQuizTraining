<?php

namespace App;

use App\Peserta;
use App\PilihanJawabanMencocokan;
use App\Soal;
use Illuminate\Database\Eloquent\Model;

class JawabanMencocokan extends Model
{
    protected $table = 'jawaban_mencocokan';
    protected $fillable = ['soal_id', 'pilihan_jawaban_mencocokan_id'];

    public function Soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function PilihanJawabanMencocokan()
    {
        return $this->belongsTo(PilihanJawabanMencocokan::class);
    }
}
