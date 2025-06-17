<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Auth;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        // Ambil id_poli dari dokter yang sedang login
        $dokter = Dokter::where('email', Auth::user()->email)->firstOrFail();
        $id_poli = $dokter->id_poli;
    
        // Ambil pasien yang memiliki daftar poli pada poli yang sama
        $pasiens = Pasien::whereHas('daftarPoli.periksa')
        ->whereHas('daftarPoli.jadwal.dokter', function ($query) use ($id_poli) {
            $query->where('id_poli', $id_poli);
        })->with([
            'daftarPoli.periksa.detailPeriksa.obat',
            'daftarPoli.jadwal.dokter'
        ])->get();
    
        return view('dokter.riwayat.index', compact('pasiens'));
    }
    
    
}
