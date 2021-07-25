<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIA-VolleyBall | User</title>
    
    {{-- bootstrap 5.0 --}}
    <link rel="stylesheet" href="/bootstrap-5.0.1/css/bootstrap.min.css">
    
    {{-- bootstrap-icons --}}
    <link rel="stylesheet" href="/bootstrap-icons-1.5.0/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    
    {{-- customize css --}}
    <link rel="stylesheet" href="/css/app.css">

    <style>
        main > .container {
            padding: 30px 15px 60px 0px;
            }
    </style>
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">PBV. Tunas Banyumanik</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }} <i class="bi bi-person-fill"></i></a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <img src="/images/PBV TUNAS BANYUMANIK.jpg" class="rounded mx-auto d-block" alt="logo" style="width:100px;heigth:100px">
                        </li>                        
                        <h6
                            class="sidebar-heading d-flex justify-content-center align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>| {{ Auth::user()->name }} |</span>
                            <a class="link-secondary" href="#" aria-label="Add a new report">
                                <span data-feather="plus-circle"></span>
                            </a>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href={{route('user.dashboard')}}>
                                {{-- <span data-feather="home"></span> --}}
                                <i class="bi bi-house-door"></i>
                                Dashboard
                            </a>
                        </li>
                        </h6>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href={{route('user.formulir')}}>
                                {{-- <span data-feather="home"></span> --}}
                                <i class="bi bi-calendar-plus"></i>
                                Formulir Anggota
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link dropdown">
                                <i class="bi bi-newspaper"></i>

                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Daftar Anggota
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href={{route('user.anggota',12)}}>Usia 12 Tahun</a></li>
                                  <li><a class="dropdown-item" href={{route('user.anggota',15)}}>Usia 15 Tahun</a></li>
                                  <li><a class="dropdown-item" href={{route('user.anggota',17)}}>Usia 17 Tahun</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{route('user.jadwal',0)}}>
                                <i class="bi bi-clipboard"></i>
                                Jadwal Latihan
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href={{route('user.pelatih')}}>
                                <i class="bi bi-people-fill"></i>
                                Daftar Nama Pelatih
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link dropdown">
                                <i class="bi bi-graph-up"></i>
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hasil Penilaian
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href={{route('user.nilai',12)}}>Usia 12 Tahun</a></li>
                                  <li><a class="dropdown-item" href={{route('user.nilai',15)}}>Usia 15 Tahun</a></li>
                                  <li><a class="dropdown-item" href={{route('user.nilai',17)}}>Usia 17 Tahun</a></li>
                                </ul>
                            </div>
                        </li>                     
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        @yield('pageHeader')
                    </h1>                    
                </div>
                
                @yield('content-user')

            </main>
        </div>
    </div>
    

    <script src="/bootstrap-5.0.1/popper.min.js"></script>
    <script src="/bootstrap-5.0.1/js/bootstrap.min.js"></script>
</body>
</html>