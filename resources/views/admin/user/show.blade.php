@extends('layouts.main')
@section('customize-style')
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            /* Pastikan padding termasuk dalam ukuran total */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center mt-3">
                <h1 class="d-flex align-items-center mt-3">
                    <i class="bi bi-bookmark-star-fill fs-1 me-2"></i>
                    Detail User
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3 mt-3">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('kelola-pengguna.index') }}"
                        class="btn btn-warning d-inline-flex align-items-center px-3 py-2" role="button"
                        title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
            <hr>

            <div class="row justify-content-center mb-3">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4 mb-3">
                        <!-- Konten Item -->
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="{{ $user->image_url }}" alt="{{ $user->image_url }}"
                                    class="img-fluid me-1 rounded">
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">User ID</small>
                                <p class="card-text"><span class="badge bg-secondary">{{ $user->id }}</span></p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Nama User</small>
                                <h5 class="card-title text-primary"><b>{{ $user->name }}</b></h5>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Email</small>
                                <p class="card-text">{{ $user->email }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Status</small>
                                <p class="card-text">
                                    {{ $user->status == 1 ? 'Aktif' : ($user->status == 2 ? 'Banned' : 'Tidak Aktif') }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Role</small>
                                <p class="card-text">
                                    <span class="badge text-bg-primary">{{ $user->roles()->first()->name ?? '-' }}</span>
                                </p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Email</small>
                                <p class="card-text">{{ $user->email }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Alamat</small>
                                <p class="card-text">{{ $user->alamat }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">RT/RW</small>
                                <p class="card-text">{{ $user->rt }}/{{ $user->rw }}</p>
                            </div>
                        </div>

                        <!-- Footer Card -->
                        <div class="card-footer text-center bg-light rounded-bottom">
                            <a href="{{ route('kelola-pengguna.edit', $user->id) }}"
                                class="btn btn-primary btn-sm"><span><i class="bi bi-pencil-square fs-5"></i></span>
                                Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
