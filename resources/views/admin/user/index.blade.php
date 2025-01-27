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
            <div class="title d-flex justify-content-between align-items-center mt-3 p-3 primary-color rounded">
                <h1 class="d-flex align-items-center text-white">
                    <i class="bi bi-people-fill fs-1 me-2"></i>
                    Daftar Pengguna
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

            @can('tambah-user')
                <div class="d-flex mb-3">
                    <a href="{{ route('kelola-pengguna.create') }}" class="btn btn-success">Tambah Data</a>
                </div>
            @endcan

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Role</th>
                            <th scope="col">RT</th>
                            <th scope="col">RW</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listUser as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->status == 1 ? 'Aktif' : ($user->status == 2 ? 'Banned' : 'Tidak Aktif') }}
                                </td>
                                <td>{{ $user->roles()->first()->name ?? '-' }}</td>
                                <td>{{ $user->rt ?? '-' }}</td>
                                <td>{{ $user->rw ?? '-' }}</td>
                                <td>{{ $user->alamat ?? '-' }}</td>
                                <td>
                                    <img src="{{ $user->image_url }}" alt="{{ $user->image_url }} " width="100px"
                                        height="100px">
                                </td>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <a href="{{ route('kelola-pengguna.show', $user->id) }}"
                                            class="btn btn-primary me-2">Detail</a>
                                        @can('ubah-user')
                                            <a href="{{ route('kelola-pengguna.edit', $user->id) }}"
                                                class="btn btn-warning me-2">Edit</a>
                                        @endcan

                                        @can('hapus-user')
                                            <form action="{{ route('kelola-pengguna.destroy', $user->id) }}" method="post">
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
            <div class="d-flex justify-content-center mt-3">
                {{ $listUser->links() }}
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
