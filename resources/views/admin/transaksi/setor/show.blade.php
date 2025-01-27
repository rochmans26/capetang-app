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
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-eye fs-1 me-2"></i>
                    Detail Penyetoran Sampah
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Tombol Kembali -->
                    <a href="javascript:history.back()" class="btn btn-warning d-inline-flex align-items-center px-3 py-2"
                        role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
            <hr>

            <div class="row justify-content-center mb-3">
                <div class="col-md-10 mb-3">
                    <div class="card mx-1 mb-2 shadow-sm">
                        <!-- Konten Item dalam Satu Baris -->
                        <div class="d-flex align-items-center justify-content-between p-2">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <img src="{{ $setorSampah->image_url }}" alt="Sample Item"
                                        class="img-fluid me-1 rounded" width="auto">
                                </div>
                                <div class="col-md-6">
                                    <div class="me-2 ms-2">
                                        <small class="text-muted">ID</small>
                                        <h5>{{ $setorSampah->id }}</h5>

                                        <small class="text-muted">Nama Penyetor</small>
                                        <h1 class="card-title text-primary fw-bold">{{ $setorSampah->user->name }}</h1>

                                        <small class="text-muted">Kategori</small>
                                        <p class="card-text mt-2">
                                            {{ $setorSampah->kategori->nama_kategori }}
                                        </p>

                                        <small class="text-muted">Berat Sampah</small>
                                        <p class="card-text mt-2">
                                            {{ $setorSampah->berat_sampah }}
                                        </p>

                                        <small class="text-muted">Point</small>
                                        <p class="card-text mt-2">
                                            {{ $setorSampah->point ?? '-' }}
                                        </p>

                                        @can('ubah-penyetoran-sampah')
                                            <div class="my-3">
                                                <a href="{{ route('penyetoran-sampah.edit', $setorSampah->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <span><i class="bi bi-pencil-square"></i></span> Edit
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
