<?php

namespace App\Helpers;

use App\Models\Pasien;
use Carbon\Carbon;

class GeneralHelper
{
    public static function generateNoRM()
    {
        $tanggal = Carbon::now();
        $prefix = $tanggal->format('Ym'); // contoh: 202506

        // Cari no_rm terakhir di bulan dan tahun yang sama
        $lastPasien = Pasien::where('no_rm', 'like', $prefix . '-%')
            ->orderBy('no_rm', 'desc')
            ->first();

        if ($lastPasien) {
            $lastNumber = (int) substr($lastPasien->no_rm, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Format hasil akhir: 202506-001
        return $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
