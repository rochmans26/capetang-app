<h1>Edit quest</h1>

<form action="{{ route('quest.update', $quest->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="nama_quest">Nama quest:</label>
        <input type="text" id="nama_quest" name="nama_quest" value="{{ $quest->nama_quest }}"><br><br>
        @error('nama_quest')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="{{ $quest->deskripsi }}"><br><br>
        @error('deskripsi')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="waktu_mulai">Waktu Mulai:</label>
        <input type="datetime-local" id="waktu_mulai" name="waktu_mulai" value="{{ $quest->waktu_mulai }}"><br><br>
        @error('waktu_mulai')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="waktu_berakhir">Waktu Selesai:</label>
        <input type="datetime-local" id="waktu_berakhir" name="waktu_berakhir"
            value="{{ $quest->waktu_berakhir }}"><br><br>
        @error('waktu_berakhir')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="point">point:</label>
        <input type="text" id="point" name="point" value="{{ $quest->point }}"><br><br>
        @error('point')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
