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
                    <i class="bi bi-arrow-left-right fs-1 me-2 text-success"></i>
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
            <div class="d-flex mb-3">
                <a href="" class="btn btn-success">Tambah Data</a>
            </div>
            @if (session('success'))
                <script>
                    alert('{{ session('success') }}');
                </script>
            @endif
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
                                <th scope="row">1</th>
                                <td>
                                    <img src="{{ asset('img/' . $item->image_url) }}" alt="{{ $item->nama_item }}"
                                        width="50" height="50" class="me-2 rounded">
                                </td>
                                <td>{{ $item->nama_item }}</td>
                                <td>{{ $item->stok_item }}</td>
                                <td>{{ $item->point_item }} Poin</td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('item.show', $item->id) }}"
                                            class="btn btn-primary me-2">Detail</a>
                                        <a href="{{ route('item.edit', $item->id) }}" class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@section('customize-script', '')
