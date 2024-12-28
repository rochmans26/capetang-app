<aside id="sidebar" class="shadow">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="bi bi-grid"></i>
        </button>
        <div class="sidebar-logo">
            <a class="navbar-brand" href="{{ route('users.dashboard') }}">Capetang</a>
        </div>
    </div>
    <hr class="text-white">
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="{{ route('users.dashboard') }}" class="sidebar-link">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#sampah" aria-expanded="false" aria-controls="sampah">
                <i class="bi bi-recycle"></i>
                <span>Pengelolaan Sampah</span>
            </a>
            <ul id="sampah" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ auth()->user()->hasRole('admin') ? route('kategori-sampah.index') : route('users.kategori-sampah') }}"
                        class="sidebar-link">
                        Kategori Sampah
                    </a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('users.riwayat-setor-sampah') }}" class="sidebar-link">Riwayat Setor Sampah</a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#quest" aria-expanded="false" aria-controls="quest">
                <i class="bi bi-bookmarks-fill"></i>
                <span>Quest</span>
            </a>
            <ul id="quest" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('users.list-quest') }}" class="sidebar-link">Semua Quest</a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('users.quest-user') }}" class="sidebar-link">Quest Anda</a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#reward" aria-expanded="false" aria-controls="reward">
                <i class="bi bi-coin"></i>
                <span>Reward</span>
            </a>
            <ul id="reward" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('users.riwayat-reward') }}" class="sidebar-link">Reward Point</a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('users.riwayat-tukar-poin') }}" class="sidebar-link">Riwayat Tukar Point</a>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('users.penukaran-poin') }}" class="sidebar-link">
                <i class="bi bi-arrow-left-right"></i>
                <span>Tukar Point</span>
            </a>
        </li>
        @if (Auth::user()->hasRole('admin'))
            <hr>
            <li class="sidebar-item">
                <a href="/kelola-pengguna" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Kelola User</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/kategori-sampah" class="sidebar-link">
                    <i class="bi bi-recycle"></i>
                    <span>Kelola Kategori Sampah</span>
                </a>
            </li>
        @endif
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#setting" aria-expanded="false" aria-controls="setting">
                <i class="bi bi-gear-fill"></i>
                <span>Setting</span>
            </a>
            <ul id="setting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('users-profile') }}" class="sidebar-link">Profile</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('password.edit') }}" class="sidebar-link">Ubah Password</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="bi bi-box-arrow-left"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
