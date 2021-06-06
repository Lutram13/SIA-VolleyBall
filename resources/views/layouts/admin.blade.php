<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIA-VolleyBall | Admin</title>
    
    {{-- bootstrap 5.0 --}}
    <link rel="stylesheet" href="/bootstrap-5.0.1/css/bootstrap.min.css">

    {{-- bootstrap-icons --}}
    <link rel="stylesheet" href="/bootstrap-icons-1.5.0/bootstrap-icons.css">

    {{-- customize css --}}
    <link rel="stylesheet" href="/css/app.css">

    <style>
        main > .container {
            padding: 30px 15px 60px 0px;
            }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href={{route('admin.dashboard')}}>Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href={{route('admin.anggota',12)}}>Daftar Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jadwal Latihan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Daftar Nama Pelatih</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hasil Penilaian</a>
                    </li>
                </ul>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <i class="bi bi-person-fill"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-shrink-0">
        <div class="container">
            @yield('content-admin')          
        </div>
    </main>


    <script src="/bootstrap-5.0.1/popper.min.js"></script>
    <script src="/bootstrap-5.0.1/js/bootstrap.min.js"></script>
</body>
</html>

