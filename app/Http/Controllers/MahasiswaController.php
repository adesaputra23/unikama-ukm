<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        $list_mahasiswa     = Mahasiswa::all();
        $map_fakultas       = Pegawai::MAP_FAKULTAS;
        $map_prodi          = Pegawai::MAP_PRODI;
        $fakultas           = Pegawai::MAP_ARRAY_FAKULTAS;
        $prodi              = Pegawai::MAP_ARRAY_PRODI;
        $role_user          = User::ROLE_USER;
        $agama              = Mahasiswa::MAP_AGAMA;
        $jenis_kelamin      = Mahasiswa::MAP_JENIS_KELAMIN;
        if (User::Is_Kaprodi()) {
            $is_user = Auth::user();
            $list_mahasiswa = Mahasiswa::where('prodi', $is_user->Pegawai->prodi)->get();
            $fakultas = array_filter($fakultas, function($var) use ($is_user){
                return ($var['id'] == $is_user->Pegawai->faklutas);
            });
        }

        return view('mahasiswa.index', compact('list_mahasiswa', 'map_fakultas', 'map_prodi', 'fakultas', 'prodi', 'role_user', 'agama', 'jenis_kelamin'));
    }

    public function AjaxGetByID($npm = null)
    {
        $mhs = Mahasiswa::with('user')->where('npm', $npm)->first();
        return response()->json($mhs);
    }
}
