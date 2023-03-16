<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ukm extends Model
{
    protected $table        = 'ukm';
    protected $primaryKey   = 'kode_ukm';
    protected $keyType      = 'string';
    public $incrementing    = false;

    public function PemilihanUkms(){
    	return $this->hasMany('App\PilihanUKM', 'kode_ukm', 'kode_ukm');
    }

    public static function GetMaxMin($data)
    {
        if ($data->jenis_kriteria == 'Benefit') {
            $nilai = 'Max ('.Penilaian::where('npm', Auth::user()->user_name)->where('kode_kriteria', $data->kode_kriteria)->max('nilai').')';
        }else{
            $nilai = 'Min ('.Penilaian::where('npm', Auth::user()->user_name)->where('kode_kriteria', $data->kode_kriteria)->min('nilai').')';
        }
        return $nilai;
    }

    public static function GetUkmByKode($kode_ukm = null)
    {
        return self::where('kode_ukm', $kode_ukm)->first();
    }
}
