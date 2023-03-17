<?php

namespace App\Http\Controllers;

use App\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $list_tingkat_kepentingan = Kriteria::TINGKAT_KEPENTINGAN;
        $list_standar_kriteria = Kriteria::STANDAR_KRITERIA;
        $list_kriteria = Kriteria::all();
        return view('kriteria.index', compact('list_tingkat_kepentingan', 'list_standar_kriteria', 'list_kriteria'));
    }

    public function Save(Request $request)
    {
        try {
            $kriteria = Kriteria::where('kode_kriteria', $request->kode_kriteria)->first();
            if ($request->aksi == 'tambah') {
                if ($kriteria && $kriteria->kode_kriteria == $request->kode_kriteria) {
                    return redirect()->back()->withInput()->with('error', 'Kode sudah digunakan!');
                }
                $kriteria = new Kriteria();
                $kriteria->kode_kriteria = $request->kode_kriteria;
                $kriteria->created_at = date('Y-m-d H:i:s');
            }
                $id = ($kriteria && $kriteria->id_kriteria) ? $kriteria->id_kriteria : '';
                $sum_nilai = $this->GetNilaiSum($id);
                $nilai_total = (int)$sum_nilai + (int)$request->nilai;
                if ($nilai_total > 100) {
                    return redirect()->back()->withInput()->with('error', 'Jumlah nilai lebih dari 100!');
                }
                $kriteria->nama_kriteria = $request->nama_kriteria;
                $kriteria->jenis_kriteria = $request->jenis;
                $kriteria->nilai = $request->nilai;
                $kriteria->updated_at = date('Y-m-d H:i:s');
                $kriteria->save();
                return redirect()->back()->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage());
        }
    }

    public function Hapus(Request $request)
    {
        try {
            $id = $request->id_kriteria;
            $user = Kriteria::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data'. $th->getMessage());
        }
    }

    public function AjaxGetById($id = null)
    {
        $kriteria = Kriteria::find($id);
        return response()->json($kriteria);
    }

    public static function GetNilaiSum($id)
    {
        $sum_nilai = Kriteria::select('nilai')->where('id_kriteria', '<>', $id)->get()->sum('nilai');
        return $sum_nilai;
    }


}
