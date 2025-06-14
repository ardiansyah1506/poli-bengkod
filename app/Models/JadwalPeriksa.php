<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    use HasFactory;

    protected $table = 'jadwal_periksa';

    protected $fillable = ['id_dokter', 'hari', 'jam_mulai', 'jam_selesai','status'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }

    // Konversi enum hari ke nama hari
    public function getNamaHariAttribute()
    {
        $hariEnum = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        return $hariEnum[$this->hari] ?? 'Tidak diketahui';
    }
}
