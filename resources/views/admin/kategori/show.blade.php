<h1>Detail Kategori Sampah</h1>

<p>ID: {{ $kategori->id }}</p>
<p>Nama Kategori: {{ $kategori->nama_kategori }}</p>
<p>Deskripsi: {{ $kategori->deskripsi }}</p>

<a href="{{ route('kategori-sampah.index') }}">Kembali</a>
