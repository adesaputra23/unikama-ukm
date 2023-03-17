<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::middleware(['guest'])->group(function () {
    Route::get('login', 'UserController@formLogin')->name('form.login');
    Route::post('login', 'UserController@Login')->name('login');
});
Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', 'HomeController@Dashboard')->name('dashboard');
    Route::get('logout', 'UserController@Logout')->name('logout');

    /* --- PENGGUNA --- */
    // Pegawai
    Route::get('pengguna/pegawai/index', 'UserController@index')->name('pengguna.pegawai.index');
    Route::post('pengguna/pegawai/save', 'UserController@Save')->name('pengguna.pegawai.save');
    Route::post('pengguna/pegawai/hapus', 'UserController@Hapaus')->name('pengguna.pegawai.hapus');
    // ajax 
    Route::get('pengguna/pegawai/ajax-get/{id}', 'UserController@AjaxGetByID');

    // Mahasiswa
    Route::get('pengguna/mahasiswa/index', 'UserController@UserMahasiswa')->name('pengguna.mahasiswa.index');
    Route::post('pengguna/mahasiswa/save', 'UserController@MahasiswaSave')->name('pengguna.mahasiswa.save');

    /* ----- UKM -----*/
    Route::get('ukm/index', 'UkmController@index')->name('ukm.index');
    Route::post('ukm/save', 'UkmController@Save')->name('ukm.save');
    Route::post('ukm/hapus', 'UkmController@Hapaus')->name('ukm.hapus');
    // ajax
    Route::get('ukm/ajax-get/{kode_ukm}', 'UkmController@AjaxGetByKode');

    // Penilaian UKM
    Route::get('ukm/penilaian', 'UkmController@Penilaian')->name('ukm.penilaian');
    Route::get('ukm/penilaian/ubah', 'UkmController@PenilaianUbah')->name('ukm.penilaian.ubah');
    Route::get('ukm/penilaian/hapus', 'UkmController@PenilaianHapus')->name('ukm.penilaian.hapus');
    Route::post('ukm/penilaian-save', 'UkmController@PenilaianSave')->name('ukm.penilaian.save');
    Route::get('ukm/penilaian/detail', 'UkmController@PenilaianDetail')->name('ukm.penilaian.detail');

    // Rekomendasi UKM
    Route::get('ukm/rekomendasi', 'UkmController@Rekomendasi')->name('ukm.rekomendasi');
    Route::post('ukm/rekomendasi-save', 'UkmController@RekomendasiSave')->name('ukm.rekomendasi.save');

    // Penilaian
    Route::get('penilaian', 'UkmController@GetPenilaian')->name('penilaian.index');
    Route::get('penilaian/data-mhs/{kode_ukm}', 'UkmController@GetPenilaianMhs')->name('penilaian.mhs');



    /* ----- Kriteria -----*/
    Route::get('kriteria/index', 'KriteriaController@index')->name('kriteria.index');
    Route::post('kriteria/save', 'KriteriaController@Save')->name('kriteria.save');
    Route::post('kriteria/hapus', 'KriteriaController@Hapus')->name('kriteria.hapus');
    // ajax
    Route::get('kriteria/ajax-get/{id_kriteria}', 'KriteriaController@AjaxGetById');

    /* ----- MAHASISWA -----*/
    Route::get('mahasiswa/index', 'MahasiswaController@index')->name('mahasiswa.index');
    Route::get('mahasiswa/ajax-get/{npm}', 'MahasiswaController@AjaxGetByID');

    /* ----- KAPRODI -----*/
    Route::get('kaprodi/index', 'KaprodiController@index')->name('kaprodi.index');
    Route::get('kaprodi/ajax-get/{nidn}', 'KaprodiController@AjaxGetByID');

    /* ----- PROFIL -----*/
    Route::get('profil', 'UserController@Profil')->name('profil');
    Route::post('profil/save', 'UserController@ProfilSave')->name('profil.save');

    // ajax get data grafik
    Route::get('ukm/ajax-get-grafik', 'UkmController@AjaxGetUkmGrafik');


});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
