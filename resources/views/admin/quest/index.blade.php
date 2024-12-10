<div>
    <h1>Daftar Quest</h1>

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
                    <th>Nama quest</th>
                    <th>Deskripsi</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Berakhir</th>
                    <th>Point</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listQuest as $quest)
                    <tr>
                        <td>{{ $quest->id }}</td>
                        <td>{{ $quest->nama_quest }}</td>
                        <td>{{ $quest->deskripsi }}</td>
                        <td>{{ $quest->waktu_mulai }}</td>
                        <td>{{ $quest->waktu_berakhir }}</td>
                        <td>{{ $quest->point }}</td>
                        <td>
                            <a href="{{ route('quest.show', $quest->id) }}">Lihat</a>
                            <a href="{{ route('quest.edit', $quest->id) }}">Edit</a>
                            <form action="{{ route('quest.destroy', $quest->id) }}" method="post">
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

    <a href="{{ route('quest.create') }}">Tambah quest</a>
</div>
