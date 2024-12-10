<h1>Perbarui Quest</h1>

<form action="{{ route('update-quest', $quest->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div>
        <label for="bukti_penyerahan">Bukti Penyerahan:</label>
        <input type="file" id="bukti_penyerahan" name="bukti_penyerahan" accept="image/jpg,image/jpeg,image/png"><br><br>
        @error('bukti_penyerahan')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <button type="submit">Simpan</button>
</form>
