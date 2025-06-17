@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        @php
        $role = Auth::user()->role;
    @endphp

    @if ($role === 'dokter')
        @include('dashboard.dokter')
    @elseif ($role === 'admin')
        @include('dashboard.admin')
    @elseif ($role === 'pasien')
        @include('dashboard.pasien')
    @else
        <div class="alert alert-danger">
            Role tidak dikenali.
        </div>
    @endif
    </section>
@endsection
