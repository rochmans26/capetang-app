<h1>Tambah Pengguna Baru</h1>

<form action="{{ route('kelola-pengguna.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <label for="name">Nama Lengkap:</label>
    <input type="text" id="name" name="name"><br><br>
    @error('name')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    @error('email')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>
    @error('password')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="password_confirmation">Konfirmasi Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
    @error('password_confirmation')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="">Pilih Status</option>
        <option value="1">Aktif</option>
        <option value="2">Banned</option>
        <option value="0">Tidak Aktif</option>
    </select><br><br>
    @error('status')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="">Pilih Role</option>
        @foreach ($listRole as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select><br><br>
    @error('role')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="rt">RT:</label>
    <input type="text" id="rt" name="rt"><br><br>
    @error('rt')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="rw">RW:</label>
    <input type="text" id="rw" name="rw"><br><br>
    @error('rw')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat"><br><br>
    @error('alamat')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="foto">Foto:</label>
    <input type="file" id="foto" name="foto" accept="image/jpg,image/jpeg,image/png"><br><br>
    @error('foto')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror


    <button type="submit">Simpan</button>
</form>
