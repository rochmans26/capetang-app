<div>
    <h1>Daftar Role</h1>

    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Role</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listRole as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a href="{{ route('role.show', $role->id) }}">Lihat</a>
                            <a href="{{ route('role.edit', $role->id) }}">Edit</a>
                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('delete')

                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('role.create') }}">Tambah Role</a>
</div>
