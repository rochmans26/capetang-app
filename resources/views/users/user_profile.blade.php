@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-person-circle text-warning"></i>
                    Profile
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
                    <div class="my-3 d-flex justify-content-center align-items-center">
                        <img id="preview-image" src="{{ $user->image_url }}" alt="Profile Image" class="rounded-circle"
                            width="150" height="150">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users-profile.update') }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control" required
                                    placeholder="Nama Lengkap" value="{{ $user->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required
                                    placeholder="Email" value="{{ $user->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="wilayah_bank_unit" class="form-label">Wilayah Bank Unit</label>
                                <input type="text" id="wilayah_bank_unit" name="wilayah_bank_unit" class="form-control"
                                    disabled value="{{ $user->wilayah_bank_unit }}">
                            </div>

                            <div class="mb-3">
                                <label for="id_role" class="form-label">Role</label>
                                <input type="text" id="id_role" name="id_role" class="form-control" disabled
                                    value="{{ $user->id_role }}">
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control"
                                    accept="image/jpg,image/jpeg,image/png" onchange="previewImage(event)">
                                @error('foto')
                                    <script>
                                        alert('{{ $message }}');
                                    </script>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Ubah Profile</button>
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

    @if (session('error'))
        <script>
            alert('{{ session('error') }}');
        </script>
    @endif

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview-image');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
