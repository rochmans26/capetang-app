<h1>Edit Role</h1>

<form action="{{ route('role.update', $role->id) }}" method="post">
    @csrf
    @method('put')

    <div>
        <label for="name">Nama Role:</label>
        <input type="text" id="name" name="name" value="{{ $role->name }}"><br><br>
        @error('name')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="description">Deskripsi:</label>
        <input type="text" id="description" name="description" value="{{ $role->description }}"><br><br>
        @error('description')
            <script>
                alert('{{ $message }}');
            </script>
        @enderror
    </div>

    <div>
        <label for="permission">Permission:</label>
        <select name="permission[]" id="permission" multiple>
            <option value="">Pilih Permission</option>
            @foreach ($permissions as $permission)
                <option value="{{ $permission->id }}"
                    {{ in_array($permission->id, $rolePermissions) ? 'selected' : '' }}>
                    {{ $permission->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>
