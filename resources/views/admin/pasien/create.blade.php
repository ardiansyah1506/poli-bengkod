@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Tambah Pasien</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('pasien.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Opsional)</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No. KTP</label>
                            <input type="text" id="no_ktp" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" required>
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_rm" class="form-label">No. Rekam Medis</label>
                            <input type="text" id="no_rm" name="no_rm" value="{{ $generatedNoRM }}" readonly class="form-control">
                        </div>
                        

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
