<h1>Tambah Quest</h1>

<form action="{{ route('quest.store') }}" method="post">
    @csrf

    <label for="nama_quest">Nama Quest:</label>
    <input type="text" id="nama_quest" name="nama_quest"><br><br>
    @error('nama_quest')
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

    <label for="waktu_mulai">Waktu Mulai:</label>
    <input type="datetime-local" id="waktu_mulai" name="waktu_mulai"><br><br>
    @error('waktu_mulai')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="waktu_berakhir">Waktu Selesai:</label>
    <input type="datetime-local" id="waktu_berakhir" name="waktu_berakhir"><br><br>
    @error('waktu_berakhir')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="point">Point:</label>
    <input type="number" id="point" name="point"><br><br>
    @error('point')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <button type="submit">Simpan</button>
</form>
