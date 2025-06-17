@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Daftar Poli</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-poli.store') }}" method="POST">
                {{-- <form action="" method="POST"> --}}
                    @csrf

                    <div class="mb-3">
                        <label>No RM</label>
                        <input type="text" name="no_rm" value="{{ $pasien }}" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="poli" class="form-label">Pilih Poli</label>
                        <select id="poli" class="form-control" required>
                            <option value="">-- Pilih Poli --</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_jadwal" class="form-label">Pilih Jadwal</label>
                        <select name="id_jadwal" id="jadwal" class="form-control" required>
                            <option value="">-- Pilih Jadwal --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea name="keluhan" class="form-control" required></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('daftar-poli.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('adminlte_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const polis = @json($polis);

    $('#poli').on('change', function() {
        const selectedPoliId = $(this).val();
        const jadwalDropdown = $('#jadwal');
        jadwalDropdown.empty().append('<option value="">-- Pilih Jadwal --</option>');

        if (selectedPoliId) {
            const selectedPoli = polis.find(p => p.id == selectedPoliId);
            console.log(selectedPoli)

            if (selectedPoli && selectedPoli.dokter) {
                selectedPoli.dokter.forEach(dokter => {
                    dokter.jadwal.forEach(jadwal => {
                        const text = `${namaHari(jadwal.hari)}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}`;
                        const option = new Option(text, jadwal.id);
                        jadwalDropdown.append(option);
                    });
                });
            }
        }
    });

    function namaHari(hari) {
        const hariMap = {
            1: 'Senin',
            2: 'Selasa',
            3: 'Rabu',
            4: 'Kamis',
            5: 'Jumat',
            6: 'Sabtu',
            7: 'Minggu',
        };
        return hariMap[hari] || 'Tidak diketahui';
    }
</script>
@endsection
