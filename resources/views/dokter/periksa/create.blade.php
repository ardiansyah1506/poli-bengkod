@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4>Tambah Data Periksa</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('periksa.store') }}" method="POST" id="formPeriksa">
            @csrf
            <div class="mb-3">
                <label>Pasien</label>
                <select name="id_pasien" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Dokter</label>
                <select name="id_dokter" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Periksa</label>
                <input type="date" name="tgl_periksa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Obat</label>
                <select name="id_obat[]" class="form-select select2" id="obatSelect" multiple>
                    @foreach($obats as $obat)
                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Total Harga Obat</label>
                <input type="text" id="totalHarga" class="form-control" readonly>
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

        $('#obatSelect').on('change', function() {
            let total = 0;
            $('#obatSelect option:selected').each(function() {
                total += parseInt($(this).data('harga')) || 0;
            });
            $('#totalHarga').val('Rp ' + total.toLocaleString());
        });
    });
</script>
@endsection

