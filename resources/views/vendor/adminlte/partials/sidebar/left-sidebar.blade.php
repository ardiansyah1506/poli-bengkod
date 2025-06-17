<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        @php
    $user = auth()->user();
    $nama = $user->email;

    if ($user->role == 'pasien') {
        $pasien = \App\Models\Pasien::where('email', $user->email)->first();
        $nama = $pasien ? $pasien->nama : 'Pasien';
    } elseif ($user->role == 'dokter') {
        $dokter = \App\Models\Dokter::where('email', $user->email)->first();
        $nama = $dokter ? $dokter->nama : 'Dokter';
    } elseif ($user->role == 'admin') {
        $nama = 'Admin';
    }
@endphp
<div class="d-flex align-items-center user-panel mt-3 mb-3 pb-3">
    <!-- User Avatar -->
    <div class="image position-relative">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($nama) }}&background={{ auth()->user()->role == 'admin' ? 'DC3545' : (auth()->user()->role == 'dokter' ? '28A745' : '007BFF') }}&color=fff&size=128&font-size=0.5&rounded=true&bold=true"
             class="img-circle elevation-3 border border-2 border-white" 
             alt="Avatar {{ $nama }}"
             style="width: 45px; height: 45px; object-fit: cover;">
        
    </div>

    <!-- User Info -->
    <div class="info flex-grow-1 ml-3">
            <!-- User Role & Additional Info -->
            <div class="d-flex align-items-center justify-content-between mt-1">
                 <span class="text-white h5 font-weight-bold" >{{ $nama }}</span>
              
                <!-- Role Badge -->
                <span class="badge badge-{{ auth()->user()->role == 'admin' ? 'danger' : (auth()->user()->role == 'dokter' ? 'success' : 'primary') }} badge-pill px-2 py-1"
                      style="font-size: 14px; font-weight: 500;">
                    @switch(auth()->user()->role)
                        @case('admin')
                            <i class="fas fa-crown mr-1"></i>Admin
                            @break
                        @case('dokter')
                            <i class="fas fa-user-md mr-1"></i>Dokter
                            @break
                        @default
                            <i class="fas fa-user mr-1"></i>Pasien
                    @endswitch
                </span>
            </div>
            
            <!-- Last Login Info -->
          
    </div>
</div>
    {{-- <div class="image">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($nama) }}&background=0D8ABC&color=fff"
             class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{ $nama }}</a>
        <span class=" mt-2 badge badge-{{ auth()->user()->role == 'admin' ? 'danger' : (auth()->user()->role == 'dokter' ? 'success' : 'primary') }} float-right">
            {{ ucfirst(auth()->user()->role) }}
        </span>
    </div> --}}

<nav class="pt-2 ">
    <ul class="nav nav-pills nav-sidebar  flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
        data-widget="treeview" role="menu"
        @if(config('adminlte.sidebar_nav_animation_speed') != 300)
            data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
        @endif
        @if(!config('adminlte.sidebar_nav_accordion'))
            data-accordion="false"
        @endif>

        {{-- ADMIN --}}
        @if(auth()->user()->role == 'admin')
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active ' : '' }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dokter.index') }}" class="nav-link {{ Route::is('dokter.index') ? 'active ' : '' }}">
                    <i class="fas fa-user-md nav-icon"></i>
                    <p>Dokter</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.index') }}" class="nav-link {{ Route::is('pasien.index') ? 'active ' : '' }}">
                    <i class="fas fa-procedures nav-icon"></i>
                    <p>Pasien</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('poli.index') }}" class="nav-link {{ Route::is('poli.index') ? 'active ' : '' }}">
                    <i class="fas fa-hospital nav-icon"></i>
                    <p>Poli</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('obat.index') }}" class="nav-link {{ Route::is('obat.index') ? 'active ' : '' }}">
                    <i class="fas fa-capsules nav-icon"></i>
                    <p>Obat</p>
                </a>
            </li>

        {{-- DOKTER --}}
        @elseif(auth()->user()->role == 'dokter')
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active ' : '' }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('periksa.index') }}" class="nav-link {{ Route::is('periksa.index') ? 'active ' : '' }}">
                    <i class="fas fa-notes-medical nav-icon"></i>
                    <p>Periksa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jadwal.index') }}" class="nav-link {{ Route::is('jadwal.index') ? 'active ' : '' }}">
                    <i class="fas fa-calendar-check nav-icon"></i>
                    <p>Jadwal Periksa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('riwayat.index') }}" class="nav-link {{ Route::is('riwayat.index') ? 'active ' : '' }}">
                    <i class="fas fa-history nav-icon"></i>
                    <p>Riwayat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.index') }}" class="nav-link {{ Route::is('profile.index') ? 'active ' : '' }}">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Profile</p>
                </a>
            </li>

        {{-- PASIEN --}}
        @else
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active ' : '' }}">
                    <i class="fas fa-tachometer-alt nav-icon"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('daftar-poli.index') }}" class="nav-link {{ Route::is('daftar-poli.index') ? 'active ' : '' }}">
                    <i class="fas fa-clinic-medical nav-icon"></i>
                    <p>Daftar Poli</p>
                </a>
            </li>
        @endif

        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link text-danger d-flex align-items-center border-0 bg-transparent w-100">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p class="ml-2 mb-0">Keluar</p>
                </button>
            </form>
        </li>
        
        
    </ul>
</nav>

    </div>

</aside>
