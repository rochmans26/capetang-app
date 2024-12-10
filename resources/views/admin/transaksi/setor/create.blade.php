<h1>Penyetoran Sampah</h1>

<form action="{{ route('penyetoran-sampah.store') }}" method="post">
    @csrf

    <label for="tgl_setor_sampah">Tanggal Setor:</label>
    <input type="datetime-local" id="tgl_setor_sampah" name="tgl_setor_sampah"><br><br>
    @error('tgl_setor_sampah')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="id_user">ID User:</label>
    <select id="id_user" name="id_user">
        @foreach ($listUser as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select><br><br>
    @error('id_user')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="id_kategori">ID Kategori:</label>
    <select id="id_kategori" name="id_kategori">
        @foreach ($listKategori as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select><br><br> @error('id_kategori')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="berat_sampah">Berat Sampah:</label>
    <input type="text" id="berat_sampah" name="berat_sampah"><br><br>
    @error('berat_sampah')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="bukti_penyerahan">Bukti Penyerahan:</label>
    <input type="file" id="bukti_penyerahan" name="bukti_penyerahan" accept="image/jpg,image/jpeg,image/png"><br><br>
    @error('bukti_penyerahan')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <button type="submit">Simpan</button>
</form>
