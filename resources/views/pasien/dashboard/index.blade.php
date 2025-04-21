@extends('layouts.app')
@section('content_header_title','Dashboard')
@section('content')
<div class="p-4">
    <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
    <p class="mt-2">Ini adalah dashboard pasien.</p>
</div>
@endsection
