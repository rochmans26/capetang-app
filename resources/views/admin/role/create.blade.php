<h1>Tambah Role</h1>

<form action="{{ route('role.store') }}" method="post">
    @csrf

    <label for="nama_role">Nama Role:</label>
    <input type="text" id="nama_role" name="nama_role"><br><br>
    @error('nama_role')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="deskripsi">Deskripsi:</label>
    <input type="text" id="deskripsi" name="deskripsi"><br><br>
    @error('deskripsi')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <button type="submit">Simpan</button>
</form>
