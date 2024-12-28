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
                    <i class="bi bi-bookmark-star-fill fs-1 me-2 text-success"></i>
                    Edit Quest
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
                    <form action="{{ route('quest.update', $quest->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama_quest" name="nama_quest"
                                placeholder="Nama Quest" value="{{ $quest->nama_quest }}">
                            <label for="nama_quest">Nama Quest</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Deskripsi Quest ..." id="deskripsi" name="deskripsi" style="height: 100px">{{ $quest->deskripsi }}</textarea>
                            <label for="deskripsi">Deskripsi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="datetime-local" class="form-control" id="waktu_mulai" name="waktu_mulai"
                                value="{{ $quest->waktu_mulai }}">
                            <label for="waktu_mulai">Waktu Mulai</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="datetime-local" class="form-control" id="waktu_berakhir" name="waktu_berakhir"
                                value="{{ $quest->waktu_berakhir }}">
                            <label for="waktu_berakhir">Waktu Berakhir</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="point" name="point"
                                placeholder="Point Item" value="{{ $quest->point }}">
                            <label for="point">Poin Quest</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="gambar" name="gambar" placeholder="Gambar"
                                accept="image/jpg,image/jpeg,image/png">
                            <label for="gambar">Gambar</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
