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
                    <i class="bi bi-arrow-left-right fs-1 me-2 text-success"></i>
                    Tambah Data Item
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

            <div class="row justify-content-center">
                <div class="col-md-10 mb-3">
                    <form action="{{ route('item.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama_item" name="nama_item"
                                placeholder="Nama Item">
                            <label for="nama_item">Nama Item</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="stok_item" name="stok_item"
                                placeholder="Stok Item">
                            <label for="stok_item">Stok Item</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Deskripsi item ..." id="deskripsi_item" name="deskripsi_item"
                                style="height: 100px"></textarea>
                            <label for="deskripsi_item">Deskripsi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="point_item" name="point_item"
                                placeholder="Point Item">
                            <label for="point_item">Poin Item</label>
                        </div>

                        <div class="mb-3">
                            <label for="foto_item"><small class="text-muted">Foto Item</small></label>
                            <input type="file" id="foto_item" name="foto_item" accept="image/jpg,image/jpeg,image/png"
                                class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
