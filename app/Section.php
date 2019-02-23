<?php

namespace App;

use App\Peserta;
use App\Paket;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $fillable = ['nama'];

    public function Paket()
    {
        return $this->HasMany(Paket::class);
    }
    public function Peserta()
    {
        return $this->HasMany(Peserta::class);
    }
}
