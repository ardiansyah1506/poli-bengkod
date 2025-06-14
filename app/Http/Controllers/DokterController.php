<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poli')->get(); // dengan relasi poli
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all(); // untuk dropdown pilihan poli
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|max:100',
            'alamat'  => 'required|max:255',
            'email'   => 'nullable|email|max:100',
            'no_hp'   => 'required|max:15',
            'id_poli' => 'required|exists:poli,id',
        ]);

        Dokter::create($request->all());
        
        User::create([
            'email' => $request->email,
            'role' => 'dokter',
            'password' => Hash::make('password'), // Password default 'password'
        ]);
        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama'    => 'required|max:100',
            'alamat'  => 'required|max:255',
            'email'   => 'nullable|email|max:100',
            'no_hp'   => 'required|max:15',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus.');
    }
}