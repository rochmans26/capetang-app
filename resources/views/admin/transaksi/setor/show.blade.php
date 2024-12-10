<h1>Detail Setor Sampah</h1>

<p>ID: {{ $setorSampah->id }}</p>
<p>Tanggal Setor: {{ $setorSampah->tgl_setor_sampah }}</p>
<p>User: {{ $setorSampah->user->name }}</p>
<p>Kategori: {{ $setorSampah->kategori->nama_kategori }}</p>
<p>Berat Sampah: {{ $setorSampah->berat_sampah }}</p>
<p>Point: {{ $setorSampah->point }}</p>

<a href="{{ route('penyetoran-sampah.index') }}">Kembali</a>
