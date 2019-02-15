<?php

namespace App;

use App\Soal;
use App\Peserta;
use Illuminate\Database\Eloquent\Model;

class JawabanPilihanGanda extends Model
{
    protected $table = 'jawaban_pilihan_ganda';
    protected $fillable = ['pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban', 'soal_id'];

    public function Soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function Peserta()
    {
        return $this->belongsToMany(Peserta::class ,'jawaban_peserta_pilihan_ganda','jawaban_piliham_ganda_id', 'peserta_id')->withPivot('jawaban_peserta')->withTimeStamps();
    }
}
