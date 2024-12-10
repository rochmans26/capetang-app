<div>
    <h1>List Transaksi Penukaran Point</h1>

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
                    <th>ID User</th>
                    <th>Tanggal Transaksi</th>
                    <th>Total Transaksi</th>
                    <th>Status Transaksi</th>
                    <th>Bukti Penyerahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listTransaksi as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id }}</td>
                        <td>{{ $transaksi->id_user }}</td>
                        <td>{{ $transaksi->tgl_transaksi }}</td>
                        <td>{{ $transaksi->total_transaksi }}</td>
                        <td>{{ $transaksi->status_transaksi }}</td>
                        <td>
                            <img src="{{ $transaksi->image_url }}" alt="{{ $transaksi->image_url }}" width="100px"
                                height="100px">
                        </td>
                        <td>
                            <a href="{{ route('penukaran-poin.show', $transaksi->id) }}">Lihat</a>
                            <a href="{{ route('penukaran-poin.edit', $transaksi->id) }}">Edit</a>
                            <form action="{{ route('penukaran-poin.destroy', $transaksi->id) }}" method="post">
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

    <a href="{{ route('penukaran-poin.create') }}">Tambah Transaksi</a>
</div>
