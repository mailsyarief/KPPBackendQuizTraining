<?php

namespace App;
use App\JawabanMencocokan;
use Illuminate\Database\Eloquent\Model;

class PilihanJawabanMencocokan extends Model
{
    protected $table = 'pilihan_jawaban_mencocokan';
    protected $fillable = ['pilihan_jawaban', 'paket_id'];

    public function JawabanMencocokan()
    {
        return $this->hasOne(JawabanMencocokan::class);
    }

    public function Paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
