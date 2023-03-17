<?php

namespace App\Http\Controllers;

use App\Kriteria;
use App\Pegawai;
use App\Penilaian;
use App\PilihanUKM;
use App\Ukm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UkmController extends Controller
{
    public function index()
    {
        $list_ukm = Ukm::all();
        return view('Ukm.index', compact('list_ukm'));
    }

    public function Save(Request $request)
    {
        try {

            $missage = [
                'foto.mimes' => 'File bukan jpeg,png,jpg',
                'foto.max' => 'File lebih dari 2MB',
            ];

            $validator = Validator::make($request->all(), [
                'foto' => 'mimes:jpeg,png,jpg|max:2048',
            ], $missage);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->messages()->all()[0])->withInput();
            }

            $file = $request->file('foto');
            if ($file != null) {
                $extension = $file->getClientOriginalExtension();
                $name = str_replace(" ", "_", $request->kode_ukm).'_'.date('His').'.'.$extension;
            }

            $kode_ukm = (isset($request->kode_ukm) ? $request->kode_ukm : null);
            $ukm = Ukm::where('kode_ukm', $kode_ukm)->first();
            if ($request->aksi == 'tambah') {
                if (!empty($ukm)) {
                    return redirect()->back()->with('error', 'Kode UKM sudah digunakan');
                }
                $ukm = new Ukm();
                $ukm->created_at = date('Y-m-d H:i:s');
                $ukm->kode_ukm      = $kode_ukm;
            }
            $ukm->nama_ukm      = $request->nama_ukm;
            $ukm->tgl_terbentuk = $request->tgl_terbentuk;
            $ukm->deskripsi     = $request->deskripsi;
            $ukm->foto_ukm      = $name ?? $ukm->foto_ukm;
            $ukm->updated_at    = date('Y-m-d H:i:s');

            if ($ukm->save() && $file != null) {
                $tujuan_upload = 'file_foto_ukm';
                $file->move($tujuan_upload,$name);
            }

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal, terjadi kesalahan saat menyimpan data, '. $th->getMessage().'/'.$th->getLine());
        }

    }

    public function AjaxGetByKode($kode_ukm = null)
    {
        $ukm = Ukm::where('kode_ukm', $kode_ukm)->first();
        return response()->json($ukm);
    }

    public function Hapaus(Request $request)
    {
        try {
            $id = $request->hapus_ukm_kode;
            $ukm = Ukm::find($id);
            $ukm->delete();
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data'. $th->getMessage());
        }
    }

    // Penilaian UKM Mahasiswa
    public function Penilaian()
    {
        $list_penilaian = Penilaian::with('ukm', 'kriteria')->where('npm', Auth::user()->user_name)->get()->groupBy('kode_ukm');
        $list_ukm = Ukm::all();
        $list_kriteria = Kriteria::all();
        $kriteria_count = Kriteria::select('kode_kriteria')->count();
        return view('ukm.penilaian_ukm', compact('list_ukm', 'list_kriteria', 'kriteria_count', 'list_penilaian'));
    }

    public function PenilaianUbah()
    {
        $list_penilaian = Penilaian::with('ukm', 'kriteria')->where('npm', Auth::user()->user_name)->get()->groupBy('kode_ukm');
        $list_ukm = Ukm::all();
        $list_kriteria = Kriteria::all();
        $kriteria_count = Kriteria::select('kode_kriteria')->count();
        return view('ukm.ubah_penilaian_ukm', compact('list_ukm', 'list_kriteria', 'kriteria_count', 'list_penilaian'));
    }

    public function PenilaianSave(Request $request)
    {
        try {

            if ($request->aksi == 'ubah') {
                Penilaian::where('npm', Auth::user()->user_name)->delete();
            }

            $nilai = $request->nilai;
            foreach ($nilai as $key => $value) {
                $new_penilaian                  = new Penilaian();
                $new_penilaian->npm             = Auth::user()->user_name;
                $new_penilaian->kode_ukm        = $request->kode_ukm[$key];
                $new_penilaian->kode_kriteria   = $request->kode_kriteria[$key];
                $new_penilaian->nilai           = $value;
                $new_penilaian->created_at      = date('Y-m-d H:i:s');
                $new_penilaian->updated_at      = date('Y-m-d H:i:s');
                $new_penilaian->save();
            }
            return redirect()->route('ukm.penilaian')->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()->route('ukm.penilaian')->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage());
        }
    }

    public function PenilaianHapus()
    {
        try {
            $del_penilaian = Penilaian::where('npm', Auth::user()->user_name);
            $del_penilaian->delete();
            return redirect()->route('ukm.penilaian')->with('success', 'Data berhasil di hapus');
        } catch (\Throwable $th) {
            return redirect()->route('ukm.penilaian')->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage());
        }
    }

    public function PenilaianDetail(Request $request)
    {   
        $npm = Auth::user()->user_name;
        if (isset($request->npm)) {
            $npm = $request->npm;
        }
        $list_penilaian = Penilaian::with('ukm', 'kriteria')->where('npm', $npm)->get()->groupBy('kode_ukm');
        $list_normalisasi = $this->SetNormalisasi($list_penilaian, $request);
        $list_nilai_akhir = $this->SetNilaiAkhir($request);
        $list_ukm = Ukm::all();
        $list_kriteria = Kriteria::all();
        $kriteria_count = Kriteria::select('kode_kriteria')->count();
        return view('ukm.detailPenilaian', compact('list_penilaian', 'list_kriteria', 'list_ukm', 'kriteria_count', 'list_normalisasi', 'list_nilai_akhir'));
    }

    public function Rekomendasi()
    {
        $get_nilai_akhir = $this->SetNilaiAkhir(null);
        usort($get_nilai_akhir, fn($a, $b) => $b['nilai_akhir'] <=> $a['nilai_akhir']);
        $first_ukm = $get_nilai_akhir[0] ?? null;
        $other_ukm = array_slice($get_nilai_akhir, 1, 3);
        return view('ukm.rekomendasi', compact('first_ukm', 'other_ukm'));
    }

    public function SetNormalisasi($data, $req)
    {
        $npm = Auth::user()->user_name;
        if (isset($req->npm)) {
            $npm = $req->npm;
        }
        $list_kriteria = Kriteria::all();
        $array_nilai = [];
        foreach ($data as $item => $values) {
            foreach ($list_kriteria as $key => $value) {
                $array_nilai[$item]['kode_ukm'] = $values[$key]->ukm->kode_ukm;
                $array_nilai[$item]['nama_ukm'] = $values[$key]->ukm->nama_ukm;
                if ($values[$key]->kriteria->jenis_kriteria == 'Benefit') {
                    $array_nilai[$item]['nilai'][] = $values[$key]->nilai / Penilaian::where('npm', $npm)->where('kode_kriteria', $values[$key]->kriteria->kode_kriteria)->max('nilai');
                } else {
                    $array_nilai[$item]['nilai'][] = Penilaian::where('npm', $npm)->where('kode_kriteria', $values[$key]->kriteria->kode_kriteria)->min('nilai') / $values[$key]->nilai;
                }
            }
        }
        return $array_nilai;
    }

    public function SetNilaiAkhir($req)
    {
        $npm = Auth::user()->user_name;
        if (isset($req->npm)) {
            $npm = $req->npm;
        }

        $list_penilaian = Penilaian::with('ukm', 'kriteria')->where('npm', $npm)->get()->groupBy('kode_ukm');
        $list_kriteria = Kriteria::all()->toArray();
        $list_normalisasi = $this->SetNormalisasi($list_penilaian, $req);
        $array_nilai_akhir = [];
        $array_datas = [];
        foreach ($list_normalisasi as $kode_ukm => $normalisasi) {
            foreach ($list_kriteria as $key_kriteria => $kriteria) {
                $array_nilai_akhir[$kode_ukm]['kode_ukm'][] = $normalisasi['kode_ukm'];
                $array_nilai_akhir[$kode_ukm]['nama_ukm'][] = $normalisasi['nama_ukm'];
                $array_nilai_akhir[$kode_ukm]['nilai_akhir'][] = $normalisasi['nilai'][$key_kriteria] * $list_kriteria[$key_kriteria]['nilai'];
            }
        }
        foreach ($array_nilai_akhir as $key => $value) {
            $array_datas[$key]['kode_ukm']  = $value['kode_ukm'][0];
            $array_datas[$key]['nama_ukm']  = $value['nama_ukm'][0];
            $array_datas[$key]['nilai_akhir'] = array_sum($value['nilai_akhir']);
        }

        return $array_datas;
    }

    public function RekomendasiSave(Request $request)
    {
        try {

            if ($request->aksi == 'batal') {
                $new_save = PilihanUKM::where('npm', $request->npm)->where('kode_ukm', $request->ukm_kode)->delete();
            }else{
                $new_save = PilihanUKM::where('npm', $request->npm)->first();
                if (!$new_save) {
                    $new_save = new PilihanUKM();
                    $new_save->created_at = date('Y-m-d H:i:s');
                }
                $new_save->npm          = $request->npm;
                $new_save->kode_ukm     = $request->ukm_kode;
                $new_save->nilai_akhir  = $request->nilai_akhir;
                $new_save->tahun        = date('Y');
                $new_save->updated_at   = date('Y-m-d H:i:s');
                $new_save->save();
            }
            return redirect()->back()->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memilih UKM'. $th->getMessage());
        }
    }

    public function GetPenilaian()
    {
        $list_ukm = Ukm::with('PemilihanUkms')->get();
        return view('penilaian.index', compact('list_ukm'));
    }

    public function GetPenilaianMhs($kode_ukm)
    {
        $fakultas = Pegawai::MAP_FAKULTAS;
        $prodi = Pegawai::MAP_PRODI;
        $ukm = Ukm::where('kode_ukm', $kode_ukm)->first();
        $list_mhs = PilihanUKM::with('Mhs','Ukm')->where('kode_ukm', $kode_ukm)->get();
        return view('penilaian.get_mhs', compact('list_mhs', 'fakultas', 'prodi', 'ukm'));
    }

    public function AjaxGetUkmGrafik()
    {
        $list_ukm = Ukm::with('PemilihanUkms')->get();
        foreach ($list_ukm as $key => $value) {
            $newst['nama_ukm'][] = $value->nama_ukm;
            $newst['nilai'][]    = count($value->PemilihanUkms);
        }
        return response()->json($newst);
    }

}
