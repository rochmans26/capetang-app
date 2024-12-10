<h1>Edit kategori sampah</h1>

<form action="{{ route('kategori-sampah.update', $kategori->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="nama_kategori">Nama kategori:</label>
        <input type="text" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}"><br><br>
        @error('nama_kategori')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="{{ $kategori->deskripsi }}"><br><br>
        @error('deskripsi')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
