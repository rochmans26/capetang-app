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
                    Edit Data Pengguna
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('kelola-pengguna.index') }}"
                        class="btn btn-warning d-inline-flex align-items-center px-3 py-2" role="button"
                        title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>

            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-10 mb-3">
                    <form action="{{ route('kelola-pengguna.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                            <label for="name">Nama Lengkap</label>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ $user->email }}" required>
                            <label for="email">Email</label>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Password Confirmation" required>
                            <label for="password_confirmation">Konfirmasi Password</label>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="2" {{ old('status', $user->status) == 2 ? 'selected' : '' }}>Banned
                                </option>
                                <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                            <label for="status">Status</label>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih Role</option>
                                @foreach ($listRole as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->roles->first()->id === $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="role">Role</label>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rt" name="rt" placeholder="RT"
                                value="{{ $user->rt }}" required>
                            <label for="rt">RT</label>
                            @error('rt')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="rw" name="rw" placeholder="RW"
                                value="{{ $user->rw }}" required>
                            <label for="rw">RW</label>
                            @error('rw')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                value="{{ $user->alamat }}" required>
                            <label for="alamat">Alamat</label>
                            @error('alamat')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control" id="foto" name="foto"
                                accept="image/jpg,image/jpeg,image/png" value="{{ $user->foto }}">
                            <label for="foto">Foto</label>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tombol Submit -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kelola-pengguna.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
