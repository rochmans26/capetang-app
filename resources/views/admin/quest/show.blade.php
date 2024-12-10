<h1>Detail quest</h1>

<p>ID: {{ $quest->id }}</p>
<p>Nama quest: {{ $quest->nama_quest }}</p>
<p>Deskripsi: {{ $quest->deskripsi }}</p>
<p>Waktu Mulai: {{ $quest->waktu_mulai }}</p>
<p>Waktu Berakhir: {{ $quest->waktu_berakhir }}</p>
<p>Point: {{ $quest->point }}</p>

<a href="{{ route('quest.index') }}">Kembali</a>
