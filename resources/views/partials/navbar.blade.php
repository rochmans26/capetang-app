<nav class="navbar navbar-expand-lg navbar-dark nav-color-primary">
    <div class="container-fluid">
        <div class="d-flex align-item-center">
            <div class="p-1">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Bank Sampah Capetang" width="50"
                    class="p-1 rounded bg-light">
            </div>
            <div class="p-1 d-flex align-items-center">
                <p class="mb-0 fw-bold text-white">Bank Sampah Capetang</p>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center" aria-current="page" href="#">
                        <span class="me-1 badge text-bg-warning">
                            Point Anda: {{ auth()->user()->points ?? '0' }}</span>
                        <img src="{{ asset('img/coin.png') }}" alt="Coin" width="22" class="me-2">
                        <span>|</span>
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <div class="dropdown me-3">
                    <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#"
                        id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ auth()->user()->image_url }}" alt="{{ auth()->user()->image_url }}"
                            class="rounded-circle me-2" width="28" height="28">
                        <small class="me-2">Hi, {{ auth()->user()->name ?? 'User' }}!</small>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/">Back to Landing Page</a></li>
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
            </div>
        </div>
    </div>
</nav>
