@extends('layouts.app')
@section('content_header_title','Pasien')
@section('content_header_subtitle','Periksa')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Tambah Pemeriksaan</h1>
                </div>
                <div class="card-body">
                    @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pasien.periksa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="id_pasien" class="form-label">Pasien</label>
                            <select id="id_pasien" name="id_pasien" class="form-control @error('id_pasien') is-invalid @enderror" required >
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($users as $user)
                                    @if($user->role == 'pasien')
                                        <option value="{{ $user->id }}" {{ old('id_pasien') == $user->id ? 'selected' : '' }}>
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
                            <select id="id_dokter" name="id_dokter" class="form-control @error('id_dokter') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($users as $user)
                                    @if($user->role == 'dokter')
                                        <option value="{{ $user->id }}" {{ old('id_dokter') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('id_dokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
