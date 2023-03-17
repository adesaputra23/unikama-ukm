<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilihanUKM extends Model
{
    protected $table        = 'pemilihan_ukm';
    protected $primaryKey   = 'id_pilihan_ukm';
    protected $keyType      = 'int';
    public $incrementing    = true;

    public function Ukm(){
    	return $this->hasOne('App\Ukm', 'kode_ukm', 'kode_ukm');
    }

    public function PemilihanUkms(){
    	return $this->belongsTo('App\PilihanUKM', 'kode_ukm', 'kode_ukm');
    }

    public function Mhs(){
        return $this->hasOne('App\Mahasiswa', 'npm', 'npm');
    }

}
