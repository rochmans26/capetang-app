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
            <div class="title d-flex justify-content-between align-items-center mt-3 primary-color p-3 rounded">
                <h1 class="d-flex align-items-center text-white">
                    <i class="bi bi-box-seam-fill fs-1 me-2"></i>
                    Data Item
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

            @can('tambah-item')
                <div class="d-flex mb-3">
                    <a href="{{ route('item.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
            @endcan

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Gambar Item</th>
                            <th scope="col">Nama Item</th>
                            <th scope="col">Stok Item</th>
                            <th scope="col">Poin Item</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listItem as $item)
                            <tr>
                                <td scope="row">
                                    {{ $loop->index + 1 + ($listItem->currentPage() - 1) * $listItem->perPage() }}
                                </td>
                                <td>
                                    <img src="{{ $item->image_url }}" alt="{{ $item->image_url }}" width="50"
                                        height="50" class="me-2 rounded">
                                </td>
                                <td>{{ $item->nama_item }}</td>
                                <td>{{ $item->stok_item }}</td>
                                <td>{{ $item->point_item }} Poin</td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('item.show', $item->id) }}"
                                            class="btn btn-primary me-2">Detail</a>
                                        @can('ubah-item')
                                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning me-2">Edit</a>
                                        @endcan

                                        @can('hapus-item')
                                            <form action="{{ route('item.destroy', $item->id) }}" method="post">
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
                {{ $listItem->links() }}
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
