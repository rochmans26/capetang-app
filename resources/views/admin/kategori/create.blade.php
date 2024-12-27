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
                    <i class="bi bi-recycle fs-1 me-2 text-success"></i>
                    Tambah Ketegori Sampah
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
                    <form action="{{ route('kategori-sampah.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                                placeholder="Nama kategori">
                            <label for="nama_kategori">Nama Kategori</label>
                        </div>
                        @error('nama_kategori')
                            <script>
                                alert('{{ $message }}');
                            </script>
                        @enderror
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Deskripsi kategori ..." id="deskripsi" name="deskripsi"
                                style="height: 100px"></textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>
                        @error('deskripsi')
                            <script>
                                alert('{{ $message }}');
                            </script>
                        @enderror
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('customize-script', '')
