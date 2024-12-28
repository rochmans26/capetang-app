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
                    <i class="bi bi-bookmark-star-fill fs-1 me-2 text-success"></i>
                    Daftar Quest
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
                <a href="{{ route('quest.create') }}" class="btn btn-success">Tambah Data</a>
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
                            <th scope="col">Nama Quest</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Berakhir</th>
                            <th scope="col">Poin</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listQuest as $quest)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $quest->nama_quest }}</td>
                                <td>{{ $quest->deskripsi }}</td>
                                <td>{{ $quest->waktu_mulai }}</td>
                                <td>{{ $quest->waktu_berakhir }}</td>
                                <td>{{ $quest->point }}</td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('quest.show', $quest->id) }}"
                                            class="btn btn-primary me-2">Detail</a>
                                        <a href="{{ route('quest.edit', $quest->id) }}"
                                            class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('quest.destroy', $quest->id) }}" method="post">
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
