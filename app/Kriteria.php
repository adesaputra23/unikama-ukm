<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    
    protected $table        = 'kriteria';
    protected $primaryKey   = 'id_kriteria';
    protected $keyType      = 'int';
    public $incrementing    = true;

    CONST TINGKAT_KEPENTINGAN = [
        [
            'kode_kpt'  => 1,
            'nilai_kpt' => 1,
            'nama_kpt'  => 'Sangat Tidak Penting',
        ],
        [
            'kode_kpt'  => 2,
            'nilai_kpt' => 2,
            'nama_kpt'  => 'Tidak Penting',
        ],
        [
            'kode_kpt'  => 3,
            'nilai_kpt' => 3,
            'nama_kpt'  => 'Cukup Penting',
        ],
        [
            'kode_kpt'  => 4,
            'nilai_kpt' => 4,
            'nama_kpt'  => 'Penting',
        ],
        [
            'kode_kpt'  => 5,
            'nilai_kpt' => 5,
            'nama_kpt'  => 'Sangat Penting',
        ]
    ];

    CONST STANDAR_KRITERIA = [
        [
            'kode_krt'  => 1,
            'nilai_krt' => 5,
            'nama_krt'  => 'Sangat Buruk',
        ],
        [
            'kode_krt'  => 2,
            'nilai_krt' => 4,
            'nama_krt'  => 'Buruk',
        ],
        [
            'kode_krt'  => 3,
            'nilai_krt' => 3,
            'nama_krt'  => 'Cukup',
        ],
        [
            'kode_krt'  => 4,
            'nilai_krt' => 2,
            'nama_krt'  => 'Baik',
        ],
        [
            'kode_krt'  => 5,
            'nilai_krt' => 1,
            'nama_krt'  => 'Sangat Baik',
        ]
    ];
}
