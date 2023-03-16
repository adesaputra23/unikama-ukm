<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table        = 'penilaian';
    protected $primaryKey   = 'id_penilaian';
    protected $keyType      = 'int';
    public $incrementing    = true;

    public function Ukm(){
    	return $this->hasOne('App\Ukm', 'kode_ukm', 'kode_ukm');
    }

    public function Kriteria(){
    	return $this->hasOne('App\Kriteria', 'kode_kriteria', 'kode_kriteria');
    }
}
