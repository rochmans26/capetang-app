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
                    Tambah Penyetoran Sampah
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
                    <form action="{{ route('penyetoran-sampah.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="datetime-local" class="form-control" id="tgl_setor_sampah" name="tgl_setor_sampah"
                                placeholder="Tanggal Setor" required>
                            <label for="tgl_setor_sampah">Tanggal Setor</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_user" name="id_user" required>
                                <option value="">Pilih Nama Penyetor</option>
                                @foreach ($listUser as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <label for="id_user">Nama Penyetor</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_kategori" name="id_kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($listKategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <label for="id_kategori">Kategori Sampah</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="berat_sampah" name="berat_sampah"
                                placeholder="Berat Sampah" required>
                            <label for="berat_sampah">Berat Sampah</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="bukti_penyerahan" name="bukti_penyerahan"
                                placeholder="Bukti Penyerahan" accept="image/jpg,image/jpeg,image/png">
                            <label for="bukti_penyerahan">Bukti Penyerahan</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
