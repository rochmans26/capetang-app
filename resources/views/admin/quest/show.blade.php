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
                    Detail Quest
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3 mt-3">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('quest.index') }}" class="btn btn-warning d-inline-flex align-items-center px-3 py-2"
                        role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center mb-3">
                <div class="col-md-6 mb-3">
                    <div class="card mx-1 mb-2 shadow-sm">
                        <!-- Konten Item dalam Satu Baris -->
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $quest->nama_quest }}</b></h5>
                            <hr>
                            <small class="text-muted">Deskripsi</small>
                            <p class="card-text">{{ $quest->deskripsi }}</p>
                            <small class="text-muted">Waktu Mulai</small>
                            <p class="card-text">{{ $quest->waktu_mulai }}</p>
                            <small class="text-muted">Waktu Berakhir</small>
                            <p class="card-text">{{ $quest->waktu_berakhir }}</p>
                            <small class="text-muted">Point</small>
                            <p class="card-text">{{ $quest->point }}</p>
                            <small class="text-muted">Status</small>
                            <p class="card-text">{{ $quest->status }}</p>
                            <small class="text-muted">Gambar</small><br>
                            <img src="{{ $quest->image_url }}" alt="{{ $quest->image_url }}" width="200" height="200"
                                class="me-2 rounded">

                            @can('ubah-quest')
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('quest.edit', $quest->id) }}" class="btn btn-sm btn-primary">
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
@endsection
@section('customize-script', '')
