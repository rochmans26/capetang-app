@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-recycle fs-1 me-2"></i>
                    Kategori Sampah
                </h1>

                <a href="javascript:history.back()" class="btn btn-warning d-inline-flex align-items-center" role="button"
                    title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back
                </a>
            </div>
            <hr>
            <div class="row">
                @if ($listKategori->isEmpty())
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">Kategori Sampah Masih Kosong</div>
                        </div>
                    </div>
                @else
                    @foreach ($listKategori as $kategori)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $loop->iteration }}
                                    </h5>
                                    <img src="{{ $kategori->image_url }}" alt="" class="img-fluid mb-3 rounded">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $kategori->nama_kategori }}</h6>
                                    <p class="card-text">{{ $kategori->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    {{-- end of header --}}
@endsection
@section('customize-script', '')
