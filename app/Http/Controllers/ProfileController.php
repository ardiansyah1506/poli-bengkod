<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $email = Auth::user()->email;
        $dokter = Dokter::where('email', $email)->firstOrFail();

        return view('dokter.profil.index', compact('dokter'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp'  => 'required|string|max:20',
        ]);

        $email = Auth::user()->email;
        $dokter = Dokter::where('email', $email)->firstOrFail();

        $dokter->update($request->only('nama', 'alamat', 'no_hp'));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
