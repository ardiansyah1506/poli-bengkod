@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Edit Pendaftaran Poli</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-poli.update', $daftarPoli->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="poli" class="form-label">Poli</label>
                        <select id="poli" class="form-control" required>
                            <option value="">-- Pilih Poli --</option>
                            @foreach ($polis as $poli)
                                <option value="{{ $poli->id }}" {{ $daftarPoli->jadwal->dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_jadwal" class="form-label">Jadwal</label>
                        <select name="id_jadwal" id="jadwal" class="form-control" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach ($polis as $poli)
                                @foreach ($poli->dokter as $dokter)
                                    @foreach ($dokter->jadwal as $jadwal)
                                        <option value="{{ $jadwal->id }}"
                                            data-poli="{{ $poli->id }}"
                                            {{ $daftarPoli->id_jadwal == $jadwal->id ? 'selected' : '' }}>
                                            {{ $jadwal->nama_hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                        </option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" id="keluhan" rows="3" class="form-control" required>{{ $daftarPoli->keluhan }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('daftar-poli.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script>
    const polis = @json($polis);

    $('#poli').on('change', function() {
        const selectedPoliId = $(this).val();
        const jadwalDropdown = $('#jadwal');
        jadwalDropdown.empty().append('<option value="">-- Pilih Jadwal --</option>');

        if (selectedPoliId) {
            const selectedPoli = polis.find(p => p.id == selectedPoliId);
            if (selectedPoli && selectedPoli.dokter) {
                selectedPoli.dokter.forEach(dokter => {
                    dokter.jadwal.forEach(jadwal => {
                        const namaHari = getNamaHari(jadwal.hari);
                        const optionText = `${namaHari} (${jadwal.jam_mulai} - ${jadwal.jam_selesai})`;
                        const option = new Option(optionText, jadwal.id);
                        jadwalDropdown.append(option);
                    });
                });
            }
        }
    });

    function getNamaHari(hari) {
        const hariMap = {
            1: 'Senin',
            2: 'Selasa',
            3: 'Rabu',
            4: 'Kamis',
            5: 'Jumat',
            6: 'Sabtu',
            7: 'Minggu'
        };
        return hariMap[hari] || 'Tidak diketahui';
    }
</script>
@endsection
