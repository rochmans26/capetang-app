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
        <div class="container shadow full-height rounded">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center mt-3">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-recycle fs-1 me-2 text-success"></i>
                    Kategori Sampah
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

            @can('tambah-kategori-sampah')
                <div class="d-flex mb-3">
                    <a href="{{ route('kategori-sampah.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
            @endcan

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Ketegori</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listKategori as $kategori)
                            <tr>
                                <td scope="row">
                                    {{ $loop->index + 1 + ($listKategori->currentPage() - 1) * $listKategori->perPage() }}
                                </td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td>{{ $kategori->deskripsi }}</td>
                                <td>
                                    <img src="{{ $kategori->image_url }}" alt="{{ $kategori->image_url }}" width="50"
                                        height="50" class="me-2 rounded">
                                </td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('kategori-sampah.show', $kategori->id) }}"
                                            class="btn btn-primary me-2">Detail</a>

                                        @can('ubah-kategori-sampah')
                                            <a href="{{ route('kategori-sampah.edit', $kategori->id) }}"
                                                class="btn btn-warning me-2">Edit</a>
                                        @endcan

                                        @can('hapus-kategori-sampah')
                                            <form action="{{ route('kategori-sampah.destroy', $kategori->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $listKategori->links() }}
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
