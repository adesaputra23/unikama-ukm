<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\User;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        $user_in = [User::KAPRODI];
        $list_data = Pegawai::whereHas('user', function($query) use ($user_in){
            $query->whereIn('id_role', $user_in);
        })->get();
        $fakultas           = Pegawai::MAP_ARRAY_FAKULTAS;
        $prodi              = Pegawai::MAP_ARRAY_PRODI;
        $map_fakultas       = Pegawai::MAP_FAKULTAS;
        $map_prodi          = Pegawai::MAP_PRODI;
        return view('kaprodi.index', compact('list_data', 'fakultas', 'prodi', 'map_fakultas', 'map_prodi'));
    }
}
