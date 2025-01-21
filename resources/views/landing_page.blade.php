<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <title>Capetang App</title>
    <style>
        #map {
            height: 500px;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        .jumbotron-bg {
            background-image: url('{{ asset('img/carousel-example.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* height: 468px; */
        }

        .carousel-item {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 468px;
            /* Atur tinggi agar carousel memenuhi layar */
        }

        .carousel-item:nth-child(1) {
            background-image: url('{{ asset('img/carousel-example.png') }}');
        }

        .form-signin {
            max-width: auto;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3"
            style="z-index: 1050; max-width: 350px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3"
            style="z-index: 1050; max-width: 350px;">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
            <div class="container">
                <!-- Section untuk logo dan nama aplikasi -->
                <a class="navbar-brand d-flex align-items-center" href="#">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="50" class="me-2">
                    <span>Capetang App</span>
                </a>

                <!-- Button toggler untuk layar kecil -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu navigasi -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Menu utama -->
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#howTo">Cara Kerja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                    </ul>

                    <!-- User menu dan tombol Sign In -->
                    <div class="d-flex align-items-center">
                        @if (Auth::check())
                            <!-- Dropdown User Menu jika Sudah Melakukan Sign In -->
                            <div class="dropdown me-3">
                                <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                    href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <small class="me-2">Hi, {{ ucwords(Auth::user()->name) ?? 'User' }}</small>
                                    <img src="{{ auth()->user()->image_url }}" alt="{{ auth()->user()->image_url }}"
                                        class="rounded-circle me-2" width="28" height="28">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="#">Profil</a></li>
                                    @if (Auth::user()->hasRole('admin'))
                                        <li><a class="dropdown-item" href="{{ route('users.dashboard') }}">Pusat
                                                Kelola</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('users.dashboard') }}">Pusat
                                                Kelola</a></li>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <li>
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                Log Out
                                            </a>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        @endif

                        @if (Auth::guest())
                            <!-- Tombol Sign In Muncul Jika User belum melakukan login -->
                            <a href="#" class="btn btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#login-form">Log In</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <main>
        <!-- Jumbotron -->
        <div class="container mt-4">
            <div class="p-5 mb-4 rounded-3 jumbotron-bg shadow-sm">
                <div class="container-fluid py-5 text-white">
                    <h1 class="display-5 fw-bold">Selamat Datang,</h1>
                    <h1>Di Bank Sampah Capetang!</h1>
                    <p class="col-md-8 fs-4">Peduli Sampah, Peduli Masa Depan!</p>
                    @if (Route::has('register'))
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#register-form"
                            data-bs-dismiss="modal">Daftar Sekarang</button>
                    @endif
                </div>
            </div>
        </div>

        {{-- <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-start text-white">
                            <h1 style="font-size: 45pt" class="fw-bold">Selamat Datang,</h1>
                            <h1>Di Bank Sampah Capetang!</h1>
                            <p class="opacity-100">Peduli Sampah, Peduli Masa Depan!</p>
                            <p><a class="btn btn-lg btn-light" href="#">Daftar Sekarang</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-success)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Generasi Perubahan Untuk Lingkungan Yang Lebih Baik</h1>
                            <p>Berkontribusi dalam menciptakan lingkungan yang baik untuk kehidupan</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-success)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}


        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4 d-flex flex-column align-items-center">
                    <div class="position-relative" style="width: 140px; height: 140px;">
                        <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="var(--bs-warning)" />
                        </svg>
                        <i class="bi bi-bookmark-star-fill position-absolute text-white"
                            style="top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 50px;"></i>
                    </div>
                    <h2 class="fw-normal">Quest</h2>
                    <p>Setor sampah dan ikuti quest yang disediakan oleh Bank Sampah Capetang.</p>
                    <p><a class="btn btn-success" href="#">View details &raquo;</a></p>
                </div>
                <div class="col-lg-4 d-flex flex-column align-items-center">
                    <div class="position-relative d-flex justify-content-center align-items-center"
                        style="width: 140px; height: 140px;">
                        <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="var(--bs-warning)" />
                        </svg>
                        <i class="bi bi-coin position-absolute text-white"
                            style="font-size: 60px; line-height: 1;"></i>
                    </div>
                    <h2 class="fw-normal">Point</h2>
                    <p>Dapatkan point sebanyak-banyaknya dengan mengikuti quest yang disediakan.</p>
                    <p><a class="btn btn-success" href="#">View details &raquo;</a></p>
                </div>

                <div class="col-lg-4 d-flex flex-column align-items-center">
                    <div class="position-relative" style="width: 140px; height: 140px;">
                        <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="var(--bs-warning)" />
                        </svg>
                        <i class="bi bi-arrow-left-right position-absolute text-white"
                            style="top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 50px;"></i>
                    </div>
                    <h2 class="fw-normal">Exchange</h2>
                    <p>Tukar point dan dapatkan item yang kalian inginkan di Capetang App.</p>
                    <p><a class="btn btn-success" href="#">View details &raquo;</a></p>
                </div>
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette" id="howTo">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">Ayo Gabung, <span
                            class="text-body-secondary">Dapatkan Poinnya!</span></h2>
                    <p class="lead">Silahkan daftarkan data diri Anda di web aplikasi Capetang ini dengan klik tombol
                        "Daftar Sekarang" atau <a href="#" data-bs-toggle="modal"
                            data-bs-target="#register-form" data-bs-dismiss="modal">klik disini</a></p>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('img/square-join.jpg') }}" alt="" srcset="" width="500"
                        height="500">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Tukar Poin. <span class="text-body-secondary">Dan
                            Dapatkan Hadiahnya!</span></h2>
                    <p class="lead">Anda dapat menukar poin yang Anda kumpulkan dengan item yang tersedia.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="{{ asset('img/square-gift.jpg') }}" alt="" srcset="" width="500"
                        height="500">
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">Dan terakhir. Gimana sih, caranya? <span
                            class="text-body-secondary">Gampang Banget.</span></h2>
                    <p class="lead">Gini nih, caranya ...
                    <ol>
                        <li>Daftar di web aplikasi Capetang ini.</li>
                        <li>Login akun Anda.</li>
                        <li>Kumpulkan sampah terpilah di rumah.</li>
                        <li>Setor sampah ke Bank Unit wilayah Anda.</li>
                        <li>Dapatkan poin Anda.</li>
                        <li>Tukar poin dengan hadiah yang menarik.</li>
                        <li>Terakhir, jangan lupa ikuti Quest, untuk mengumpulkan lebih banyak Poin!</li>
                    </ol>
                    </p>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('img/square-howto.jpg') }}" alt="" srcset="" width="500"
                        height="500">
                </div>
            </div>

            <hr class="featurette-divider">
            <div class="row p-4 rounded justify-content-center" id="about">
                <div class="col-lg">
                    <h1 class="text text-center mb-3  mt-5">About</h1>
                    <p class="text text-center">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure consequuntur deserunt porro
                        cupiditate sunt, hic voluptatibus voluptas omnis assumenda cum mollitia nostrum repellat
                        accusantium quis, dolorem obcaecati? Repellat nam itaque, eligendi, aliquam blanditiis, veniam
                        labore sapiente harum vitae sed quas iste? Totam quia ullam voluptatum magnam eos ipsam illum
                        amet molestiae odio, maiores quisquam quibusdam ipsa ex esse deleniti sit quidem dolorum
                        perspiciatis, repudiandae enim sequi nihil rerum laborum ut. Dolor culpa dolore quos ipsa
                        aperiam itaque at unde nihil id numquam! Maiores laboriosam mollitia, natus doloremque, vel
                        explicabo labore excepturi neque in nesciunt quos ad alias distinctio aperiam.
                    </p>
                    <div class="container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">
            <div class="row bg-success p-4 rounded justify-content-center" id="contact">
                <h1 class="text text-center mb-3 text-white">Contact</h1>
                <div class="col-lg">
                    <form method="POST" action="{{ route('feedback') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-white">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" name="email"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label text-white">Example
                                textarea</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" required></textarea>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-light">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2024 Capetang App &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
            </p>
        </footer>
    </main>

    {{-- Modal Log In --}}
    <!-- Modal Login -->
    <div class="modal fade" id="login-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-signin d-flex flex-column align-items-center justify-content-center">
                        <!-- Form Start -->
                        <form method="POST" action="{{ route('login') }}" class="text-center w-100"
                            style="max-width: auto;">
                            @csrf
                            <!-- Logo -->
                            <img class="mb-4 mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="Logo"
                                width="100">
                            <!-- Judul -->
                            <h1 class="h3 mb-3 fw-normal">Silahkan Log In</h1>

                            <!-- Input Email -->
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" name="email"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>

                            <!-- Input Password -->
                            <div class="form-floating">
                                <input type="password" class="form-control" id="floatingPassword" name="password"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check text-start my-3">
                                <input class="form-check-input" type="checkbox" value="remember-me"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>

                            <!-- Tombol Submit -->
                            <button class="btn btn-success w-100 py-2 mb-3" type="submit">Log in</button>
                        </form>
                        <!-- Form End -->
                        <!-- Tombol Daftar -->
                        @if (Route::has('register'))
                            <button class="btn btn-outline-success w-100 py-2" data-bs-toggle="modal"
                                data-bs-target="#register-form" data-bs-dismiss="modal">Daftar</button>
                        @endif
                        <!-- Footer -->
                        <p class="mt-5 mb-3 text-body-secondary">&copy; Capetang App 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="register-form" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Form Start -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Logo -->
                        <img class="mb-4 mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="Logo"
                            width="100">
                        <!-- Judul -->
                        <h1 class="h3 mb-3 fw-normal text-center">Silahkan Daftarkan Diri Anda!</h1>
                        <!-- Full Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="fullName" placeholder="Full Name"
                                name="name" required>
                            <label for="fullName">Full Name</label>
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="emailAddress" name="email"
                                placeholder="name@example.com" required>
                            <label for="emailAddress">Email Address</label>
                        </div>

                        <!-- Username -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" placeholder="Username"
                                name="username" required>
                            <label for="username">Username</label>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" required>
                            <label for="password">Password</label>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="confirmPassword"
                                name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="confirmPassword">Confirm Password</label>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
                    </form>
                    <!-- Form End -->

                    <!-- Footer -->
                    @if (Route::has('login'))
                        <p class="mt-4 text-center text-muted">
                            Already have an account? <a href="#" class="text-decoration-none"
                                data-bs-toggle="modal" data-bs-target="#login-form" data-bs-dismiss="modal">Log
                                In</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Notification Fade Out --}}
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>
    <script>
        var map = L.map('map').setView([-6.943264, 107.652910], 50); // Koordinat Jakarta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([-6.943264, 107.652910]).addTo(map)
            .bindPopup('Bandung, Indonesia')
            .openPopup();
    </script>
</body>

</html>
