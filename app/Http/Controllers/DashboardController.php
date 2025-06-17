<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use App\Models\Periksa;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
    
        $data = ['role' => $role];
    
        switch ($role) {
            case 'dokter':
                $dokter = Dokter::where('email', $user->email)->firstOrFail();
    
                $jumlahJadwal = $dokter->jadwal()->count();
                $jumlahPasien = 0;
                $jumlahPemeriksaan = 0;
    
                foreach ($dokter->jadwal as $jadwal) {
                    foreach ($jadwal->daftarPoli as $dp) {
                        $jumlahPasien++;
                        if ($dp->periksa) {
                            $jumlahPemeriksaan++;
                        }
                    }
                }
    
                $data += compact('dokter', 'jumlahJadwal', 'jumlahPasien', 'jumlahPemeriksaan');
                break;
    
            case 'admin':
                $totalDokter = Dokter::count();
                $totalPasien = Pasien::count();
                $totalJadwal = JadwalPeriksa::count();
                $totalPemeriksaan = Periksa::count();
    
                $data += compact('totalDokter', 'totalPasien', 'totalJadwal', 'totalPemeriksaan');
                break;
    
            case 'pasien':
                $pasien = Pasien::where('email', $user->email)->firstOrFail();
    
                $totalKunjungan = $pasien->daftarPoli()->count();
                $totalPemeriksaan = $pasien->daftarPoli()->whereHas('periksa')->count();
    
                $data += compact('pasien', 'totalKunjungan', 'totalPemeriksaan');
                break;
    
            default:
                abort(403, 'Role tidak dikenali.');
        }
    
        return view('dashboard', $data);
    }
    
}
