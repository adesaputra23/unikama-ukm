<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table        = 'pegawai';
    protected $primaryKey   = 'nidn';
    protected $keyType      = 'string';
    public $incrementing    = false;

    CONST MAP_PRODI = [
        // BAHASA & SASTRA
        1   => 'BAHASA & SASTRA INDONESIA',
        2   => 'SASTRA INGGRIS',
        3   => 'PENDIDIKAN BAHASA INGGRIS',
        
        // EKONOMI & BISNIS
        4   => 'AKUNTANSI',
        5   => 'MANAJEMEN',
        6   => 'PENDIDIKAN EKONOMI',
        
        // ILMU PENDIDIKAN
        7   => 'BIMBINGAN & KONSELING',
        8   => 'PPKN',
        9   => 'PENDIDIKAN GEOGRAFI',
        10  => 'PENDIDIKAN GURU SEKOLAH DASAR',
        11  => 'PENDIDIKAN ANAK USIA DINI',

        // SAINS & TEKNOLOGI
        12  => 'TEKNIK INFORMATIKA',
        13  => 'SISTEM INFORMASI',
        14  => 'PENDIDIKAN MATEMATIKA',
        15  => 'PENDIDIKAN FISIKA & IPA',

        // HUKUM
        16  => 'HUKUM',

        // PETERNAKAN
        17  => 'PETERNAKAN',
    ];

    CONST MAP_FAKULTAS = [
        1 => 'BAHASA & SASTRA',
        2 => 'EKONOMI & BISNIS',
        3 => 'ILMU PENDIDIKAN',
        4 => 'SAINS & TEKNOLOGI',
        5 => 'HUKUM',
        6 => 'PETERNAKAN'
    ];

    CONST MAP_ARRAY_FAKULTAS = [
        [
            'id' => 1,
            'nama' => 'BAHASA & SASTRA' 
        ],
        [
            'id' => 2,
            'nama' => 'EKONOMI & BISNIS' 
        ],
        [
            'id' => 3,
            'nama' => 'ILMU PENDIDIKAN' 
        ],
        [
            'id' => 4,
            'nama' => 'SAINS & TEKNOLOGI' 
        ],
        [
            'id' => 5,
            'nama' => 'HUKUM' 
        ],
        [
            'id' => 6,
            'nama' => 'PETERNAKAN' 
        ]
    ];

    CONST MAP_ARRAY_PRODI = [
        1 => [
            [
                'id' => 1,
                'id_fkt' => 1,
                'nama' => 'BAHASA & SASTRA INDONESIA'
            ],
            [
                'id' => 2,
                'id_fkt' => 1,
                'nama' => 'SASTRA INGGRIS'
            ],
            [
                'id' => 3,
                'id_fkt' => 1,
                'nama' => 'PENDIDIKAN BAHASA INGGRIS'
            ]
        ],

        2 => [
            [
                'id' => 4,
                'id_fkt' => 2,
                'nama' => 'AKUNTANSI'
            ],
            [
                'id' => 5,
                'id_fkt' => 2,
                'nama' => 'MANAJEMEN'
            ],
            [
                'id' => 6,
                'id_fkt' => 2,
                'nama' => 'PENDIDIKAN EKONOMI'
            ],
        ],

        3 => [
           [
               'id' => 7,
               'id_fkt' => 3,
               'nama' => 'BIMBINGAN & KONSELING'
           ],
           [
                'id' => 8,
                'id_fkt' => 3,
                'nama' => 'PPKN'
           ],
           [
                'id' => 9,
                'id_fkt' => 3,
                'nama' => 'PENDIDIKAN GEOGRAFI'
            ],
            [
                'id' => 10,
                'id_fkt' => 3,
                'nama' => 'PENDIDIKAN GURU SEKOLAH DASAR'
            ],
            [
                'id' => 11,
                'id_fkt' => 3,
                'nama' => 'PENDIDIKAN ANAK USIA DINI'
            ],
        ],

        4 => [
            [
                'id' => 12,
                'id_fkt' => 4,
                'nama' => 'TEKNIK INFORMATIKA'
            ],
            [
                'id' => 13,
                'id_fkt' => 4,
                'nama' => 'SISTEM INFORMASI'
            ],
            [
                'id' => 14,
                'id_fkt' => 4,
                'nama' => 'PENDIDIKAN MATEMATIKA'
            ],
            [
                'id' => 15,
                'id_fkt' => 4,
                'nama' => 'PENDIDIKAN FISIKA & IPA'
            ]
        ],

        5 => [
            [
                'id' => 16,
                'id_fkt' => 5,
                'nama' => 'HUKUM'
            ],
        ],

        6 => [
            [
                'id' => 17,
                'id_fkt' => 6,
                'nama' => 'PETERNAKAN'
            ],
        ]
    ];

    public function User(){
    	return $this->hasOne('App\User', 'user_name', 'nidn');
    }
}
