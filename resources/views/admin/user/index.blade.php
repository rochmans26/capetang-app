<div>
    <h1>Kelola Pengguna</h1>

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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listUser as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ $user->status == 1 ? 'Aktif' : ($user->status == 2 ? 'Banned' : 'Tidak Aktif') }}
                        </td>
                        <td>{{ $user->roles[0]->name }}</td>
                        <td>{{ $user->rt ?? '-' }}</td>
                        <td>{{ $user->rw ?? '-' }}</td>
                        <td>{{ $user->alamat ?? '-' }}</td>
                        <td>
                            <img src="{{ $user->image_url }}" alt="{{ $user->image_url }} " width="100px" height="100px">
                        </td>
                        <td>
                            <a href="{{ route('kelola-pengguna.show', $user->id) }}">Lihat</a>
                            <a href="{{ route('kelola-pengguna.edit', $user->id) }}">Edit</a>
                            <form action="{{ route('kelola-pengguna.destroy', $user->id) }}" method="post">
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

    <a href="{{ route('kelola-pengguna.create') }}">Tambah user</a>
</div>
