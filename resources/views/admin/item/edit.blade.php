<h1>Edit item</h1>

<form action="{{ route('item.update', $item->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
        <label for="nama_item">Nama item:</label>
        <input type="text" id="nama_item" name="nama_item" value="{{ $item->nama_item }}"><br><br>
        @error('nama_item')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="stok_item">stok item:</label>
        <input type="number" id="stok_item" name="stok_item" value="{{ $item->stok_item }}"><br><br>
        @error('stok_item')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror

    </div>

    <div>
        <label for="deskripsi_item">Deskripsi Item:</label>
        <input type="text" id="deskripsi_item" name="deskripsi_item" value="{{ $item->deskripsi_item }}"><br><br>
        @error('deskripsi_item')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="point_item">Point item:</label>
        <input type="number" id="point_item" name="point_item" value="{{ $item->point_item }}"><br><br>
        @error('point_item')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="foto_item">Gambar:</label>
        <input type="file" id="foto_item" name="foto_item" accept="image/jpg,image/jpeg,image/png"
            value="{{ $item->foto_item }}"><br><br>
        @error('foto_item')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
