<h1>Edit Role</h1>

<form action="{{ route('role.update', $role->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="nama_role">Nama Role:</label>
        <input type="text" id="nama_role" name="nama_role" value="{{ $role->nama_role }}"><br><br>
        @error('nama_role')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="{{ $role->deskripsi }}"><br><br>
        @error('deskripsi')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
