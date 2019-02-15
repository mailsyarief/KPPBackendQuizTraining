<?php

namespace App;

use App\Paket;
use App\JawabanMencocokan;
use App\JawabanPilihanGanda;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
    protected $fillable = ['soal_gambar','soal','tipe_soal','paket_id'];

    public function Paket()
    {
        return $this->hasMany(Paket::class);
    }

    public function JawabanMencocokan()
    {
        return $this->belongsTo(JawabanMencocokan::class);
    }

    public function JawabanPilihanGanda()
    {
        return $this->belongsTo(JawabanPilihanGanda::class);
    }
}
