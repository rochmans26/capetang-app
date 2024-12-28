@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-key text-warning"></i>
                    Ubah Password
                </h1>

                <a href="javascript:history.back()" class="btn btn-success d-inline-flex align-items-center" role="button"
                    title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back
                </a>
            </div>
            <hr>
            {{-- end of header --}}
        </div>


        <div class="row justify-content-center mx-auto my-3">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Lama</label>
                                <input type="password" id="current_password" name="current_password" class="form-control"
                                    required placeholder="Password Lama">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" id="password" name="password" class="form-control" required
                                    placeholder="Password Baru">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" required placeholder="Konfirmasi Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customize-script')
    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    {{-- @error('current_password', 'updatePassword')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    @error('password', 'updatePassword')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror --}}
@endsection
