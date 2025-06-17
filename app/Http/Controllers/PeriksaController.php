<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $dokter = Dokter::where('email', Auth::user()->email)->firstOrFail();
        $id_poli = $dokter->id_poli;
    
        // Ambil semua daftar_poli yang berkaitan dengan poli dokter ini, melalui relasi jadwal → dokter → poli
        $periksas = DaftarPoli::with(['pasien', 'periksa', 'jadwal.dokter'])
            ->whereHas('jadwal.dokter', function ($query) use ($id_poli) {
                $query->where('id_poli', $id_poli);
            })
            ->get();
    
        return view('dokter.periksa.index', compact('periksas'));
    }
    

    public function create()
    {
        $users = User::all();
        $obat =Obat::all();
        return view('dokter.periksa.create', compact('users','obat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'id_obat' => 'nullable|array',
        ]);
    
        $periksa = Periksa::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
        ]);
    
        if ($request->has('id_obat') && is_array($request->id_obat)) {
            foreach ($request->id_obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat
                ]);
            }
        }
    
        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil ditambahkan.');
    }
    

   

    public function edit(DaftarPoli $periksa)
    {
        $obats = Obat::all();
        $periksas = $periksa->periksa; // periksa bisa null
        // dd($periksas);
        $selectedObatIds = $periksas ? $periksas->detailPeriksa->pluck('id_obat')->toArray() : [];
    
        return view('dokter.periksa.edit', compact('periksa',  'obats', 'selectedObatIds', 'periksas'));
    }
    
    
    public function update(Request $request, DaftarPoli $periksa)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|string',
            'id_obat' => 'nullable|array',
        ]);
    
        // Bersihkan format: "Rp 388,000" → 388000
        $biaya = str_replace(['Rp', '.', ',',' '], '', $request->biaya_periksa);
    
        $periksas = $periksa->periksa;
        if ($periksas) {
            $periksas->update([
                'tgl_periksa' => $request->tgl_periksa,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biaya,
            ]);
    
            DetailPeriksa::where('id_periksa', $periksa->id)->delete();
        } else {
            $periksas = Periksa::create([
                'id_daftar_poli' => $periksa->id,
                'tgl_periksa' => $request->tgl_periksa,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biaya,
            ]);
        }
    
        if ($request->has('id_obat')) {
            foreach ($request->id_obat as $id_obat) {
            //    dd($id_obat);
                DetailPeriksa::create([
                    'id_periksa' => $periksas->id, // Ganti: sebelumnya salah ke `$periksa->id`
                    'id_obat' => $id_obat,
                ]);
            }
        }
    
        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil disimpan.');
    }
    

    

    public function destroy(Periksa $periksa)
    {
        $periksa->delete();

        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil dihapus.');
    }
}
