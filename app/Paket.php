<?php

namespace App;

use App\Soal;
use App\Peserta;
use App\PilihanJawabanMencocokan;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    protected $fillable = ['nama','keterangan','section_id'];

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
}
