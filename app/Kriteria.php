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

    CONST MAP_NILAI_TINGKAT_KEPENTINGAN = [
        1 => [
            'kode_kpt'  => 1,
            'nilai_kpt' => 1,
            'nama_kpt'  => 'Sangat Tidak Penting',
        ],
        2 => [
            'kode_kpt'  => 2,
            'nilai_kpt' => 2,
            'nama_kpt'  => 'Tidak Penting',
        ],
        3 => [
            'kode_kpt'  => 3,
            'nilai_kpt' => 3,
            'nama_kpt'  => 'Cukup Penting',
        ],
        4 => [
            'kode_kpt'  => 4,
            'nilai_kpt' => 4,
            'nama_kpt'  => 'Penting',
        ],
        5 => [
            'kode_kpt'  => 5,
            'nilai_kpt' => 5,
            'nama_kpt'  => 'Sangat Penting',
        ],
        0 => [
            'kode_kpt'  => 0,
            'nilai_kpt' => 0,
            'nama_kpt'  => 'Tidak Ada Nilai',
        ],
    ];

    CONST MAP_STANDAR_KRITERIA = [
        5 => [
            'kode_krt'  => 1,
            'nilai_krt' => 5,
            'nama_krt'  => 'Sangat Buruk',
        ],
        4 => [
            'kode_krt'  => 2,
            'nilai_krt' => 4,
            'nama_krt'  => 'Buruk',
        ],
        3 => [
            'kode_krt'  => 3,
            'nilai_krt' => 3,
            'nama_krt'  => 'Cukup',
        ],
        2 => [
            'kode_krt'  => 4,
            'nilai_krt' => 2,
            'nama_krt'  => 'Baik',
        ],
        1 => [
            'kode_krt'  => 5,
            'nilai_krt' => 1,
            'nama_krt'  => 'Sangat Baik',
        ],
        0 => [
            'kode_krt'  => 0,
            'nilai_krt' => 0,
            'nama_krt'  => 'Tidak Ada Nilai',
        ],
    ];
}
