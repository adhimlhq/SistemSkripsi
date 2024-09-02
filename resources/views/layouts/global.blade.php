<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">


    @yield('header')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>


<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="{{ route('home') }}" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="{{ route('home') }}" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            @if (\Auth::user())
                                <div class="d-sm-none d-lg-inline-block">Hi,
                                    {{ Auth::user()->nama }}
                                </div>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if (Auth::check() && Auth::user()->roles_id == 5)
                                <a href="{{ route('student.editprofil', [Auth::user()->id]) }}"
                                    class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                            @else
                                <a href="#" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="fas fa-sign-out-alt"> </i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('home') }}">Sita</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('home') }}">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="{{ Request::url() == url('home') ? 'class=active' : '' }}">
                            <a href="{{ route('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        </li>
                        @if (Auth::check() && Auth::user()->roles_id == 1)
                            <li class="menu-header">Administrator</li>
                            <li class="nav-item" class="{{ 'psik.indexUser' == request()->path() ? 'active' : '' }}">
                                <a href="{{ route('psik.index') }}"><i class="far fa-user"></i> <span>Manajemen
                                        Pengguna</span></a>
                            </li>
                        @elseif(Auth::check() && Auth::user()->roles_id == 2)
                            <li class="menu-header">Jurusan</li>
                            <li class="nav-item" class="">
                                <a href="" class="nav-link has-dropdown"><i
                                        class="fas fa-university"></i><span>Manajemen</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('departement.indextopic') }}">Topik
                                            Penelitian</a></li>
                                    <li><a class="nav-link" href="index.html">Seminar Proposal</a></li>
                                    <li><a class="nav-link" href="index.html">Seminar Hasil</a></li>
                                </ul>
                            </li>
                        @elseif(Auth::check() && Auth::user()->roles_id == 3)
                            <li class="menu-header">Akademik</li>
                            <li class="nav-item" class="">
                                <a href="" class="nav-link has-dropdown"><i
                                        class="fas fa-university"></i><span>Manajemen Akademik</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('academic.index') }}">Topik Penelitian</a>
                                    </li>
                                    <li><a class="nav-link" href="{{ route('academic.indexSempro') }}">Seminar
                                            Proposal</a></li>
                                    <li><a class="nav-link" href="{{ route('academic.indexSemhas') }}">Seminar
                                            Hasil</a></li>
                                </ul>
                            </li>
                        @elseif(Auth::check() && Auth::user()->roles_id == 4)
                            @yield('navbar.lecture')

                            <li class="menu-header">Dosen</li>
                            <li class="nav-item" class="">
                                <a href="" class="nav-link has-dropdown"><i
                                        class="fas fa-university"></i><span>Manajemen Bimbingan</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link" href="{{ route('lecture.indexGuidance') }}">Topik
                                            Penelitian</a></li>
                                    <li><a class="nav-link" href="{{ route('lecture.indexGuideSempro') }}">Seminar
                                            Proposal</a></li>
                                    <li><a class="nav-link" href="{{ route('lecture.indexGuideSemhas') }}">Seminar
                                            Hasil</a></li>
                                </ul>
                            </li>
                        @else(Auth::check() && Auth::user()->roles_id == 5)
                            <li class="menu-header">Mahasiswa</li>
                            <li class="nav-item" class="">
                                <a href="{{ route('student.index', [Auth::user()->id]) }}"><i
                                        class="fas fa-file-archive"></i> <span>Manajemen Skripsi</span></a>
                            </li>
                        @endif
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }}
                    <div class="bullet"></div> Design By <a href="https://getstisla.com/">STISLA</a>
                </div>
            </footer>
        </div>
    </div>

    @stack('before-scripts')
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>



    <!-- JS Libraies -->
    @stack('page-scripts')

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('after-scripts')
</body>

</html>
