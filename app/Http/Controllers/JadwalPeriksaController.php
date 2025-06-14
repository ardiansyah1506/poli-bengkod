<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use Auth;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal.create',);
    }

    public function store(Request $request)
{
    $email = Auth::user()->email;
    $dokter = Dokter::where('email', $email)->first();

    if (!$dokter) {
        return back()->with('error', 'Data dokter tidak ditemukan.');
    }
    $request->validate([
        'hari' => 'required|integer|min:1|max:7',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ]);
    

    // Jika status = 1, jadwal lain nonaktif
    if ($request->status == 1) {
        JadwalPeriksa::where('id_dokter', $dokter->id)->update(['status' => 0]);
    }

    JadwalPeriksa::create([
        'id_dokter' => $dokter->id,
        'hari' => $request->hari,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'status' => '0',
    ]);

    return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
}
    
    public function edit(JadwalPeriksa $jadwal)
    {
        $dokters = Dokter::all();
        return view('dokter.jadwal.edit', compact('jadwal', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
    
        $request->validate([
            'status' => 'nullable',
        ]);
    
        // Jika status dicentang, set aktif dan nonaktifkan yang lain
        if ($request->has('status') && $request->status == 1) {
            JadwalPeriksa::where('status', 1)->update(['status' => 0]);
            $jadwal->status = 1;
        } else {
            $jadwal->status = 0;
        }
    
        $jadwal->save();
    
        return redirect()->route('jadwal.index')->with('success', 'Status jadwal berhasil diperbarui.');
    }
    

    public function destroy(JadwalPeriksa $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
