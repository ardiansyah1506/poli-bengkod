<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function index()
        {
            $jumlahPasien = Periksa::whereDoesntHave('detailPeriksa')
            ->distinct('id_pasien')
            ->count('id_pasien');
            $jumlahObat = Obat::count();
            $userRegistrations = User::count();
            $uniqueVisitors = Periksa::distinct('id_pasien')->count('id_pasien');
            return view('home', compact(
                'jumlahPasien',
                'jumlahObat',
                'userRegistrations',
                'uniqueVisitors'
            ));
        }
}
