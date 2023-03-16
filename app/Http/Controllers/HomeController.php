<?php

namespace App\Http\Controllers;

use App\PilihanUKM;
use App\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    // new kommit

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function Dashboard()
    {
        $list_ukm = Ukm::with('PemilihanUkms')->get();
        $new_array = [];
        foreach ($list_ukm as $key => $value) {
            $newst['nama_ukm'] = $value->nama_ukm;
            $newst['nilai']    = count($value->PemilihanUkms);
            array_push($new_array, $newst);
        }
        $max_nilai = max(array_column($new_array, 'nilai'));
        foreach ($new_array as $ke => $val) {
            if ($max_nilai == $val['nilai']) {
                $new_ukm['nama_ukm'][] = $val['nama_ukm'];
            }
        }
        $string_ukm_name = implode(", ", $new_ukm['nama_ukm']);
        return view('dashboard', compact('string_ukm_name'));
    }
}
