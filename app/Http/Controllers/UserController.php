<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_in = [User::KEPALA_BAK, User::KAPRODI];
        $list_user = User::with('pegawai')->whereIn('id_role', $user_in)->get();
        $role_user = User::ROLE_USER;
        $fakultas = Pegawai::MAP_ARRAY_FAKULTAS;
        $prodi = Pegawai::MAP_ARRAY_PRODI;
        return view('pengguna.pegawai.index', compact('list_user', 'role_user', 'fakultas', 'prodi'));
    }

    public function UserMahasiswa()
    {
        $user = User::MAHASISWA;
        $list_user = User::with('mahasiswa')->where('id_role', $user)->get();
        $fakultas = Pegawai::MAP_ARRAY_FAKULTAS;
        $prodi = Pegawai::MAP_ARRAY_PRODI;
        $role_user = User::ROLE_USER;
        return view('pengguna.mahasiswa.index', compact('list_user', 'fakultas', 'prodi', 'role_user'));
    }

    public function formLogin(Request $request)
    {
        return view('login/login');
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'password'  => 'required'
        ]);
        $credentials = $request->only('user_name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->withInput($request->only('user_name', 'password'))->with('error', 'NIDN/NPM dan Password yang anda masukan salah!');
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Save(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('user_name', $request->nidn)->first();
            if (empty($user)) {
                $user = new User();
                $user->created_at   = date('Y-m-d H:i:s');
                $user->password     = Hash::make($request->nidn);
            }

            $user->user_name    = $request->nidn;
            $user->email        = $request->email;
            if (isset($request->role)) {
                $user->id_role  = $request->role;
            }
            $user->updated_at   = date('Y-m-d H:i:s');

            if ($user->save()) {
                $pegawai = Pegawai::where('nidn', $request->nidn)->first();
                if (empty($pegawai)) {
                    $pegawai = new Pegawai();
                    $pegawai->created_at = date('Y-m-d H:i:s');
                }
    
                $pegawai->nidn          = $request->nidn;
                $pegawai->nama_pegawai  = $request->nama_pegawai;
                $pegawai->faklutas      = (isset($request->fakultas)) ? $request->fakultas : null;
                $pegawai->prodi         = (isset($request->prodi)) ? $request->prodi : null;
                $pegawai->updated_at    = date('Y-m-d H:i:s');
                $pegawai->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil di simpan');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage());
        }
    }

    public function Hapaus(Request $request)
    {
        try {
            $id = $request->id_user;
            $user = User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'Data berhasil di hapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data'. $th->getMessage());
        }
    }

    public function AjaxGetByID($id = null)
    {
        $get_user = User::with('pegawai', 'mahasiswa')->where('id', $id)->first();
        return response()->json($get_user);
    }

    public function MahasiswaSave(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('user_name', $request->npm)->first();
            if (empty($user)) {
                $user = new User();
                $user->created_at = date('Y-m-d H:i:s');
                $user->password   = Hash::make($request->npm);
            }
            $user->user_name    = $request->npm;
            $user->email        = $request->email;
            $user->email        = $request->email;
            $user->id_role      = User::MAHASISWA;
            $user->updated_at   = date('Y-m-d H:i:s');
            if ($user->save()) {
                $mhs = Mahasiswa::where('npm', $request->npm)->first();
                if (empty($mhs)) {
                    $mhs = new Mahasiswa();
                    $mhs->created_at = date('Y-m-d H:i:s');
                }
                $mhs->npm               = $request->npm;
                $mhs->nama_mhs          = $request->nama_mhs;
                $mhs->fakultas          = $request->fakultas;
                $mhs->prodi             = $request->prodi;
                $mhs->agama             = (isset($request->agama) ? $request->agama : null);
                $mhs->jenis_kelamin     = (isset($request->jk) ? $request->jk : null);
                $mhs->updated_at        = date('Y-m-d H:i:s');
                $mhs->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage().$th->getLine());
        }
    }

    public function Profil()
    {
        $user_name = Auth::user()->user_name;
        $user_model = new User();
        $list_fakultas = Pegawai::MAP_FAKULTAS;
        $list_prodi = Pegawai::MAP_PRODI;
        $list_agama = Mahasiswa::MAP_AGAMA;
        $jk = Mahasiswa::MAP_JENIS_KELAMIN;
        $prodi = Pegawai::MAP_ARRAY_PRODI;
        if ($user_model->Is_Mahasiswa()) {
            $user_data = Mahasiswa::where('npm', $user_name)->first();
        }elseif ($user_model->Is_Kepala_BAK() || $user_model->Is_Kaprodi()) {
            $user_data = Pegawai::where('nidn', $user_name)->first();
        }
        return view('pengguna.profil', compact('user_data', 'list_fakultas', 'list_prodi', 'list_agama', 'jk', 'prodi'));
    }

    public function ProfilSave(Request $request)
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
                $name = str_replace(" ", "_", Auth::user()->user_name).'_'.date('His').'.'.$extension;
            }

            if (isset($request->npm)) {
                $mahasiswa = Mahasiswa::where('npm', $request->npm)->first();
                $mahasiswa->nama_mhs        = $request->nama;
                $mahasiswa->fakultas        = $request->fakultas;
                $mahasiswa->prodi           = $request->prodi;
                $mahasiswa->jenis_kelamin   = $request->jk;
                $mahasiswa->agama           = $request->agama;
                $mahasiswa->tempat_lahir    = $request->tmpt_lahir;
                $mahasiswa->tgl_lahir       = $request->tgl_lahir;
                $mahasiswa->no_tlpn         = $request->no_telpon;
                $mahasiswa->foto_mhs        = $name ?? $mahasiswa->foto_mhs;
                $mahasiswa->updated_at      = date('Y-m-d H:i:s');
                if ($mahasiswa->save() && $file != null) {
                    $tujuan_upload = 'file_foto_profil';
                    $file->move($tujuan_upload,$name);
                }
                return redirect()->back()->with('success', 'Data berhasil di ubah');
            }

            if (isset($request->nidn)) {
                $pegawai = Pegawai::where('nidn', $request->nidn)->first();
                $pegawai->nama_pegawai    = $request->nama;
                $pegawai->faklutas        = $request->fakultas;
                $pegawai->prodi           = $request->prodi;
                $pegawai->jenis_kelamin   = $request->jk;
                $pegawai->agama           = $request->agama;
                $pegawai->tempat_lahir    = $request->tmpt_lahir;
                $pegawai->tgl_lahir       = $request->tgl_lahir;
                $pegawai->no_hp           = $request->no_telpon;
                $pegawai->foto            = $name ?? $pegawai->foto;
                $pegawai->updated_at      = date('Y-m-d H:i:s');
                if ($pegawai->save() && $file != null) {
                    $tujuan_upload = 'file_foto_profil';
                    $file->move($tujuan_upload,$name);
                }
                return redirect()->back()->with('success', 'Data berhasil di ubah');
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data'. $th->getMessage().$th->getLine());
        }
    }

}
