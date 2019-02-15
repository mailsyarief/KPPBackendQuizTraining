<?php

namespace App;

use App\Peserta;
use App\JawabanMencocokan;
use Illuminate\Database\Eloquent\Model;

class PilihanJawabanMencocokan extends Model
{
    protected $table = 'pilihan_jawaban_mencocokan';
    protected $fillable = ['pilihan_jawaban'];

    public function JawabanMencocokan()
    {
        return $this->belongsTo(JawabanMencocokan::class);
    }
}
