<h1>Edit Setor Sampah</h1>

<form action="{{ route('penyetoran-sampah.update', $setorSampah->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="tgl_setor_sampah">Tanggal Setor:</label>
        <input type="datetime-local" id="tgl_setor_sampah" name="tgl_setor_sampah"
            value="{{ $setorSampah->tgl_setor_sampah }}"><br><br>
        @error('tgl_setor_sampah')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="id_user">ID User:</label>
        <select id="id_user" name="id_user" value="{{ $setorSampah->id_user }}">
            @foreach ($listUser as $user)
                <option value="{{ $user->id }}" {{ $setorSampah->id_user == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select><br><br>
        @error('id_user')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="id_kategori">ID Kategori:</label>
        <select id="id_kategori" name="id_kategori">
            @foreach ($listKategori as $kategori)
                <option value="{{ $kategori->id }}" {{ $setorSampah->id_kategori == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select><br><br>
        @error('id_kategori')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="berat_sampah">Berat Sampah:</label>
        <input type="text" id="berat_sampah" name="berat_sampah" value="{{ $setorSampah->berat_sampah }}"><br><br>
        @error('berat_sampah')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="bukti_penyerahan">Bukti Penyerahan:</label>
        <input type="file" id="bukti_penyerahan" name="bukti_penyerahan" accept="image/jpg,image/jpeg,image/png"
            value="{{ $setorSampah->bukti_penyerahan }}"><br><br>
        @error('bukti_penyerahan')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
