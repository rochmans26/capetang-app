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
                    Daftar Role
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
                <a href="{{ route('role.create') }}" class="btn btn-success">Tambah Data</a>
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
                            <th scope="col">Nama Role</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listRole as $role)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('role.show', $role->id) }}"
                                            class="btn btn-primary me-2">Detail</a>
                                        <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning me-2">Edit</a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="post">
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
