<?php

namespace App\Http\Controllers;

use App\Models\DetailPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;

class PeriksaController extends Controller
{
    public function index()
    {
        $periksas = Periksa::with(['pasien', 'dokter','detailPeriksa'])->get();
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
    

   

    public function edit(Periksa $periksa)
    {
        $users = User::all();
        $obat = Obat::all();
        
        // Ambil ID obat yang sudah terpilih sebelumnya di DetailPeriksa
        $selectedObatIds = $periksa->detailPeriksa->pluck('id_obat')->toArray();
    
        return view('dokter.periksa.edit', compact('periksa', 'users', 'obat', 'selectedObatIds'));
    }
    
    public function update(Request $request, Periksa $periksa)
    {
        // dd($request->id_obat);
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'id_dokter' => 'required|exists:users,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|integer',
            'id_obat' => 'nullable|array',
            'id_obat.*' => 'exists:obat,id',
        ]);
    
        $periksa->update([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);
    
        // Hapus semua detail lama
        DetailPeriksa::where('id_periksa', $periksa->id)->delete();
    
        // Tambahkan ulang detail obat baru
        if ($request->has('id_obat') && is_array($request->id_obat)) {
            foreach ($request->id_obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }
        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil diperbarui.');
    }
    

    public function destroy(Periksa $periksa)
    {
        $periksa->delete();

        return redirect()->route('periksa.index')->with('success', 'Data periksa berhasil dihapus.');
    }
}
