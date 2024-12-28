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
                    Penyetoran Sampah
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

            @can('tambah-penyetoran-sampah')
                <div class="d-flex mb-3">
                    <a href="{{ route('penyetoran-sampah.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
            @endcan

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal Setor Sampah</th>
                            <th scope="col">User</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Berat Sampah(gr)</th>
                            <th scope="col">Poin</th>
                            <th scope="col">Bukti Penyerahan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listSetoran as $setoran)
                            <tr>
                                <td scope="row">
                                    {{ $loop->index + 1 + ($listSetoran->currentPage() - 1) * $listSetoran->perPage() }}
                                </td>
                                <td>{{ $setoran->tgl_setor_sampah }}</td>
                                <td>{{ $setoran->user->name }}</td>
                                <td>{{ $setoran->kategori->nama_kategori }}</td>
                                <td>{{ $setoran->berat_sampah }}</td>
                                <td>{{ $setoran->point ?? '-' }}</td>
                                <td>
                                    <img src="{{ $setoran->image_url }}" alt="{{ $setoran->image_url }}" width="50"
                                        height="50" class="me-2 rounded">
                                </td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('penyetoran-sampah.show', $setoran->id) }}"
                                            class="btn btn-primary me-2">Detail</a>

                                        @can('ubah-penyetoran-sampah')
                                            <a href="{{ route('penyetoran-sampah.edit', $setoran->id) }}"
                                                class="btn btn-warning me-2">Edit</a>
                                        @endcan

                                        @can('hapus-penyetoran-sampah')
                                            <form action="{{ route('penyetoran-sampah.destroy', $setoran->id) }}"
                                                method="post">
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
                {{ $listSetoran->links() }}
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
