@extends('layouts.app')
@section('content_header_title','Periksa')
@section('content_header_subtitle','Edit')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0">Edit Pemeriksaan</h1>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('periksa.update', $periksa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="tgl_periksa" class="form-label">Tanggal Pemeriksaan</label>
                                <input type="date" id="tgl_periksa" name="tgl_periksa"
                                    class="form-control @error('tgl_periksa') is-invalid @enderror"
                                    value="{{ old('tgl_periksa', $periksa->tgl_periksa ? $periksa->tgl_periksa->format('Y-m-d') : '') }}"
                                    required>

                            </div>

                            <div class="mb-3">
                                <label for="id_pasien" class="form-label">Pasien</label>
                                <select id="id_pasien" name="id_pasien"
                                    class="form-control @error('id_pasien') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pasien --</option>
                                    @foreach ($users as $user)
                                        @if ($user->role == 'pasien')
                                            <option value="{{ $user->id }}"
                                                {{ old('id_pasien', $periksa->id_pasien) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_pasien')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_dokter" class="form-label">Dokter</label>
                                <select id="id_dokter" name="id_dokter"
                                    class="form-control @error('id_dokter') is-invalid @enderror" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach ($users as $user)
                                        @if ($user->role == 'dokter')
                                            <option value="{{ $user->id }}"
                                                {{ old('id_dokter', $periksa->id_dokter) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_dokter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea id="catatan" name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3">{{ old('catatan', $periksa->catatan) }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_obat" class="form-label">Pasien</label>
                                <select id="id_obat" name="id_obat[]" multiple
                                class="form-control @error('id_obat') is-invalid @enderror" required>
                                <option value="">-- Pilih Obat --</option>
                                @foreach ($obat as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, old('id_obat', $selectedObatIds)) ? 'selected' : '' }}>
                                        {{ $item->name_obat }}
                                    </option>
                                @endforeach
                            </select>
                            
                                @error('id_obat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('periksa.index') }}" class="btn btn-secondary">
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
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#id_obat').select2({
            placeholder: '-- Pilih Obat --',
        });
    
    });
</script>
@endsection

