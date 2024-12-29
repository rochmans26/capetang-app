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
        <div class="container shadow rounded">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center mt-3">
                <h1 class="d-flex align-items-center mt-3">
                    <i class="bi bi-bookmark-star-fill fs-1 me-2"></i>
                    Detail Role
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3 mt-3">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('role.index') }}" class="btn btn-warning d-inline-flex align-items-center px-3 py-2"
                        role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
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
                            <!-- ID Role -->
                            <div class="mb-3">
                                <small class="text-muted">ID Role</small>
                                <p class="card-text"><span class="badge bg-secondary">{{ $role->id }}</span></p>
                            </div>

                            <!-- Nama Role -->
                            <div class="mb-3">
                                <small class="text-muted">Nama Role</small>
                                <h5 class="card-title text-primary"><b>{{ $role->name }}</b></h5>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <small class="text-muted">Deskripsi</small>
                                <p class="card-text">{{ $role->description }}</p>
                            </div>

                            <!-- Permissions -->
                            <div>
                                <small class="text-muted">Permissions</small>
                                <ul class="list-group">
                                    @foreach ($role->permissions as $permission)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $permission->description }}
                                            <span class="badge bg-success">Active</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Footer Card -->
                        @can('ubah-role')
                            <div class="card-footer text-center bg-light rounded-bottom">
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-primary btn-sm"><span><i
                                            class="bi bi-pencil-square fs-5"></i></span> Edit</a>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('customize-script', '')
