<h1>Edit Data Pengguna</h1>

<form action="{{ route('kelola-pengguna.update', $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
        <label for="name">Nama Lengkap:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}"><br><br>
        @error('name')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}"><br><br>
        @error('email')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        @error('password')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Konfirmasi Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
        @error('password_confirmation')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Pilih Status</option>
            <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>Aktif</option>
            <option value="2" {{ old('status', $user->status) == 2 ? 'selected' : '' }}>Banned</option>
            <option value="0" {{ old('status', $user->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        <br><br>
        @error('status')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="">Pilih Role</option>
            @foreach ($listRole as $role)
                <option value="{{ $role->id }}" {{ $user->roles->first()->id === $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select><br><br>
        @error('role')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="rt">RT:</label>
        <input type="text" id="rt" name="rt" value="{{ $user->rt }}"><br><br>
        @error('rt')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="rw">RW:</label>
        <input type="text" id="rw" name="rw" value="{{ $user->rw }}"><br><br>
        @error('rw')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="{{ $user->alamat }}"><br><br>
        @error('alamat')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png"
            value="{{ $user->foto }}"><br><br>
        @error('foto')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
