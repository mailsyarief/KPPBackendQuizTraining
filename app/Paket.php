<?php

namespace App;

use App\Soal;
use App\Peserta;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    protected $fillable = ['nama','keterangan','section'];

    public function Peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function Soal()
    {
        return $this->hasMany(Soal::class);
    }
}
