<h1>Tambah Kategori Sampah</h1>

<form action="{{ route('kategori-sampah.store') }}" method="post">
    @csrf

    <label for="nama_kategori">Nama Kategori:</label>
    <input type="text" id="nama_kategori" name="nama_kategori"><br><br>
    @error('nama_kategori')
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
