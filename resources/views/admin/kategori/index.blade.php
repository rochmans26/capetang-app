<div>
    <h1>Kategori Sampah</h1>

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
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listKategori as $kategori)
                    <tr>
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>
                            <a href="{{ route('kategori-sampah.show', $kategori->id) }}">Lihat</a>
                            <a href="{{ route('kategori-sampah.edit', $kategori->id) }}">Edit</a>
                            <form action="{{ route('kategori-sampah.destroy', $kategori->id) }}" method="post">
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

    <a href="{{ route('kategori-sampah.create') }}">Tambah kategori</a>
</div>
