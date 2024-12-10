<h1>Detail item</h1>

<p>ID: {{ $item->id }}</p>
<p>Nama item: {{ $item->nama_item }}</p>
<p>Stok: {{ $item->stok_item }}</p>
<p>Deskripsi: {{ $item->deskripsi_item }}</p>
<p>Point: {{ $item->point_item }}</p>
<p>Gambar: {{ $item->foto_item }}</p>

<a href="{{ route('item.index') }}">Kembali</a>
