<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                @if(auth()->user()->role == 'dokter')
                <li class="nav-item">
                    <a href="{{ route('periksa.index') }}" class="nav-link {{ request()->is('periksa') ? 'active ' : '' }}">
                        <i class="fas fa-stethoscope nav-icon"></i>
                        <p>Periksa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('obat.index') }}" class="nav-link {{ request()->is('obat') ? 'active ' : '' }}">
                        <i class="fas fa-pills nav-icon"></i>
                        <p>Obat</p>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active ' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pasien.periksa.index') }}" class="nav-link {{ request()->is('periksa') ? 'active ' : '' }}">
                        <i class="fas fa-notes-medical nav-icon"></i>
                        <p>Periksa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ Route('riwayat.index') }}" class="nav-link {{ request()->is('riwayat') ? 'active ' : '' }}">
                        <i class="fas fa-history nav-icon"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
            @endif
                </ul>
        </nav>
    </div>

</aside>
