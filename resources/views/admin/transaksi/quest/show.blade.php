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

<a href="{{ route('users.quest-user') }}">Kembali</a>

@if ($quest->berlangsung() && $quest->status !== 'selesai')
    <a href="{{ route('users.perbarui-quest', $quest->id) }}">Perbarui</a>

    <form action="{{ route('users.hapus-quest', $quest->id) }}" method="post">
        @csrf
        @method('delete')

        <button type="submit">Batalkan Quest</button>
    </form>
@endif
