<div>
    <h1>Quest Tersedia</h1>

    @if (session('success'))
        <script>
            alert('{{ session('success') }}');
        </script>
    @endif

    @if (session('error'))
        <script>
            alert('{{ session('error') }}');
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
                @foreach ($questTersedia as $aktif)
                    <tr>
                        <td>{{ $aktif->id }}</td>
                        <td>{{ $aktif->nama_quest }}</td>
                        <td>{{ $aktif->deskripsi }}</td>
                        <td>{{ $aktif->waktu_mulai }}</td>
                        <td>{{ $aktif->waktu_berakhir }}</td>
                        <td>{{ $aktif->point }}</td>
                        <td>
                            @if (auth()->user()->quest()->where('id_quest', $aktif->id)->exists())
                                <a href="{{ route('detail-quest', $aktif->id) }}">Status quest</a>
                            @else
                                <a href="{{ route('quest.show', $aktif->id) }}">Detail quest</a>
                            @endif
                            <form action="{{ route('ambil-quest', $aktif->id) }}" method="post">
                                @csrf
                                @method('post')

                                <button type="submit">Ambil Quest</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h1>Quest Berakhir</h1>

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
                @foreach ($questKadaluarsa as $nonaktif)
                    <tr>
                        <td>{{ $nonaktif->id }}</td>
                        <td>{{ $nonaktif->nama_quest }}</td>
                        <td>{{ $nonaktif->deskripsi }}</td>
                        <td>{{ $nonaktif->waktu_mulai }}</td>
                        <td>{{ $nonaktif->waktu_berakhir }}</td>
                        <td>{{ $nonaktif->point }}</td>
                        <td>
                            @if (auth()->user()->quest()->where('id_quest', $nonaktif->id)->exists())
                                <a href="{{ route('detail-quest', $aktif->id) }}">Status quest</a>
                            @else
                                <a href="{{ route('quest.show', $aktif->id) }}">Detail quest</a>
                            @endif
                            <form action="{{ route('ambil-quest', $nonaktif->id) }}" method="post">
                                @csrf
                                @method('post')

                                <button type="submit">Ambil Quest</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
