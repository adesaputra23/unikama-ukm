<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table        = 'mahasiswa';
    protected $primaryKey   = 'npm';
    protected $keyType      = 'string';
    public $incrementing    = false;

    CONST MAP_AGAMA = [
        1 => 'Islam',
        2 => 'Kristen',
        3 => 'Katolik',
        4 => 'Hindu',
        5 => 'Budha',
        6 => 'Kong Hu Chu',
    ];

    CONST MAP_JENIS_KELAMIN = [
        1 => 'Laki-Laki',
        2 => 'Perempuan'
    ];

    public function User(){
    	return $this->hasOne('App\User', 'user_name', 'npm');
    }

    public function PilihanUkm(){
    	return $this->hasOne('App\PilihanUKM', 'npm', 'npm');
    }
}
