@php
    use App\User;
@endphp
<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <div class="mobile-search">
                <div class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="index.html">
                <img class="img-fluid" src="{{asset('assets/images-logo/logo-ukm-unikama.jpg')}}" alt="Theme-Logo"
                    style="width: 8rem; margin-left: 25px;" />
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <a href="#!">
                        @if (Auth::user()->UserRole->id_role == User::ADMIN)
                            <span>{{ Auth::user()->name }}</span>
                        @elseif(Auth::user()->UserRole->id_role == User::KEPALA_BAK || Auth::user()->UserRole->id_role == User::KAPRODI)
                            <span>{{ Auth::user()->Pegawai->nama_pegawai }}</span>
                        @elseif(Auth::user()->UserRole->id_role == User::MAHASISWA)
                            <span>{{ Auth::user()->Mahasiswa->nama_mhs }}</span>
                        @endif
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="show-notification profile-notification">
                        {{-- <li>
                            <a href="user-profile.html">
                                <i class="ti-user"></i> Profile
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="ti-layout-sidebar-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>