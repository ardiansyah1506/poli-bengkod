<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DaftarPoliController extends Controller
{
    public function index()
{
    $idPasien = Pasien::where('email', Auth::user()->email)->value('id');

    $daftarPolis = DaftarPoli::where('id_pasien', $idPasien)
        ->with(['jadwal.dokter.poli', 'periksa'])
        ->get()
        ->map(function ($item) {
            $jadwal = $item->jadwal;

            // Hitung antrian berdasarkan jadwal yang sama
            $antrian = DaftarPoli::whereHas('jadwal', function ($query) use ($jadwal) {
                $query->where('hari', $jadwal->hari)
                      ->where('jam_mulai', $jadwal->jam_mulai);
            })->count();

            $item->antrian = $antrian;
            $item->status_periksa = $item->periksa ? 'Selesai' : 'Menunggu';
            return $item;
        });

    return view('pasien.poli.index', compact('daftarPolis'));
}



    public function create()
    {
        $polis = Poli::with('dokter.jadwal')->get();
        $pasien = Pasien::where('email',Auth::user()->email)->value('no_rm');
        return view('pasien.poli.create', compact('polis','pasien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string|max:255',
        ]);

        // Ambil email dari user yang login
        $email = Auth::user()->email;

        // Cari pasien berdasarkan email
        $pasien = Pasien::where('email', $email)->first();

        if (!$pasien) {
            return back()->withErrors(['msg' => 'Data pasien tidak ditemukan berdasarkan email login.']);
        }

        // Cegah duplikasi pendaftaran pada jadwal yang sama
        // $existing = DaftarPoli::where('id_pasien', $pasien->id)
        //     ->where('id_jadwal', $request->id_jadwal)
        //     ->first();

        // if ($existing) {
        //     return back()->withErrors(['msg' => 'Anda sudah mendaftar pada jadwal ini.']);
        // }

        // Simpan pendaftaran poli
        DaftarPoli::create([
            'id_pasien' => $pasien->id,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()->route('daftar-poli.index')->with('success', 'Pendaftaran Poli berhasil dilakukan.');
    }

    public function edit($id)
{
    $daftarPoli = DaftarPoli::with('jadwal.dokter.poli')->findOrFail($id);
    $polis = Poli::with('dokter.jadwal')->get();

    return view('pasien.poli.edit', compact('daftarPoli', 'polis'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_jadwal' => 'required|exists:jadwal_periksa,id',
        'keluhan' => 'required|string|max:255',
    ]);

    $daftarPoli = DaftarPoli::findOrFail($id);
    $daftarPoli->update([
        'id_jadwal' => $request->id_jadwal,
        'keluhan' => $request->keluhan,
    ]);

    return redirect()->route('pasien.poli.index')->with('success', 'Pendaftaran berhasil diperbarui.');
}
}