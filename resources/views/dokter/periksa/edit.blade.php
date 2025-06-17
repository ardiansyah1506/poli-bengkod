@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Edit Data Periksa</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
            @csrf
            @method('PUT')

        
            <div class="mb-3">
                <label>Nama Pasien</label>
                <input type="text" name="nama" value="{{ $periksa->pasien->nama }}" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label>Tanggal Periksa</label>
                <input type="datetime-local" name="tgl_periksa" class="form-control" 
                       value="{{ $periksas ? \Carbon\Carbon::parse($periksas->tgl_periksa)->format('Y-m-d\TH:i') : '' }}" required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control">{{ $periksas->catatan ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label>Obat</label>
                <select name="id_obat[]" class="form-control select2" id="obatSelect" multiple>
                    @foreach($obats as $obat)
                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}"
                            {{ in_array($obat->id, $selectedObatIds) ? 'selected' : '' }}>
                            {{ $obat->nama_obat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Total Harga Obat</label>
                <input type="text" id="totalHarga" name="biaya_periksa" class="form-control" readonly
                value="Rp {{ number_format(($periksas->biaya_periksa ?? 150000), 0, ',', '.') }}">
            </div>

            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('.select2').select2();

        const biayaPeriksaAwal = 150000; // Nilai tetap awal periksa

        function hitungTotal() {
            let totalObat = 0;
            $('#obatSelect option:selected').each(function() {
                totalObat += parseInt($(this).data('harga')) || 0;
            });

            let total = biayaPeriksaAwal + totalObat;

            $('#totalHarga').val('Rp ' + total.toLocaleString('id-ID'));
        }

        // Hitung otomatis saat berubah
        $('#obatSelect').on('change', hitungTotal);

        // Hitung saat halaman pertama kali dibuka
        hitungTotal();
    });
</script>
@endsection
