<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter','detailPeriksa'])->get();
        return view('pasien.riwayat.index', compact('periksas'));
    }

}
