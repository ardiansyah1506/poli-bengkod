@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Edit Status Jadwal Periksa</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="dokter" class="form-label">Dokter</label>
                        <input type="text" class="form-control" value="{{ $jadwal->dokter->nama }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <input type="text" class="form-control" value="{{ $jadwal->nama_hari }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" value="{{ $jadwal->jam_mulai }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" value="{{ $jadwal->jam_selesai }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status" id="status"
                                value="1" {{ $jadwal->status == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">
                                Aktif (Centang untuk mengaktifkan jadwal ini)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
