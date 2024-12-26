<h1>Tambah Role</h1>

<form action="{{ route('role.store') }}" method="post">
    @csrf

    <label for="name">Nama Role:</label>
    <input type="text" id="name" name="name"><br><br>
    @error('name')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="description">Deskripsi:</label>
    <input type="text" id="description" name="description"><br><br>
    @error('description')
        <script>
            alert('{{ $message }}');
        </script>
    @enderror

    <label for="permission">Permission:</label>
    <select name="permission[]" id="permission" multiple>
        <option value="">Pilih Permission</option>
        @foreach ($permissions as $permission)
            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
        @endforeach
    </select>

    <button type="submit">Simpan</button>
</form>
