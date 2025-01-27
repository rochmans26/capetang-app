@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="container">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center p-3 rounded bg-light shadow-sm">
                <h1 class="d-flex align-items-center text-dark">
                    <i class="bi bi-person-circle fs-1 me-2"></i>
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
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" id="rt" name="rt" class="form-control"
                                    value="{{ $user->rt }}">
                            </div>

                            <div class="mb-3">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" id="rw" name="rw" class="form-control"
                                    value="{{ $user->rw }}">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control"
                                    value="{{ $user->alamat }}">
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" id="role" name="role" class="form-control" disabled
                                    value="{{ $user->roles[0]->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control"
                                    accept="image/jpg,image/jpeg,image/png" onchange="previewImage(event)">
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
