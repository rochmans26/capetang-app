<div>
    <h1>Setor Sampah</h1>

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
                    <th>Tanggal Setor Sampah</th>
                    <th>ID User</th>
                    <th>ID Kategori</th>
                    <th>Berat Sampah(gr)</th>
                    <th>Poin</th>
                    <th>Bukti Penyerahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listSetoran as $setoran)
                    <tr>
                        <td>{{ $setoran->id }}</td>
                        <td>{{ $setoran->tgl_setor_sampah }}</td>
                        <td>{{ $setoran->user->name }}</td>
                        <td>{{ $setoran->kategori->nama_kategori }}</td>
                        <td>{{ $setoran->berat_sampah }}</td>
                        <td>{{ $setoran->point }}</td>
                        <td>
                            @if ($setoran->bukti_penyerahan)
                                <img src="{{ $setoran->image_url }}" alt="{{ $setoran->image_url }} " width="100px"
                                    height="100px">
                            @else
                                <p>Tidak ada gambar</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('penyetoran-sampah.show', $setoran->id) }}">Lihat</a>
                            <a href="{{ route('penyetoran-sampah.edit', $setoran->id) }}">Edit</a>
                            <form action="{{ route('penyetoran-sampah.destroy', $setoran->id) }}" method="post">
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

    <a href="{{ route('penyetoran-sampah.create') }}">Tambah setoran</a>
</div>
