<div>
    <h1>Daftar item</h1>

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
                    <th>Nama Item</th>
                    <th>Stok Item</th>
                    <th>Deskripsi Item</th>
                    <th>Point Item</th>
                    <th>Foto Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listItem as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_item }}</td>
                        <td>{{ $item->stok_item }}</td>
                        <td>{{ $item->deskripsi_item }}</td>
                        <td>{{ $item->point_item }}</td>
                        <td>
                            <img src="{{ $item->image_url }}" alt="{{ $item->nama_item }}" width="100px" height="100px">
                        </td>
                        <td>
                            <a href="{{ route('item.show', $item->id) }}">Lihat</a>
                            <a href="{{ route('item.edit', $item->id) }}">Edit</a>
                            <form action="{{ route('item.destroy', $item->id) }}" method="post">
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

    <a href="{{ route('item.create') }}">Tambah item</a>
</div>
