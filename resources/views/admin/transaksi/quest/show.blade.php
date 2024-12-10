@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

<h1>Detail quest yang diambil</h1>

<p>ID: {{ $quest->id }}</p>
<p>Nama quest: {{ $quest->nama_quest }}</p>
<p>Deskripsi: {{ $quest->deskripsi }}</p>
<p>Waktu Mulai: {{ $quest->waktu_mulai }}</p>
<p>Waktu Berakhir: {{ $quest->waktu_berakhir }}</p>
<p>Point: {{ $quest->point }}</p>

<p>Status: {{ $quest->status }}</p>
<p>Bukti Penyerahan: {{ $quest->bukti_penyerahan }}</p>

<a href="{{ route('list-quest') }}">Kembali</a>
<a href="{{ route('perbarui-quest', $quest->id) }}">Perbarui</a>

<form action="{{ route('hapus-quest', $quest->id) }}" method="post">
    @csrf
    @method('delete')

    <button type="submit">Batalkan Quest</button>
</form>
