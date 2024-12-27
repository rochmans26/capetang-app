<h1>Detail Data Pengguna</h1>

<p>ID: {{ $user->id }}</p>
<p>Nama: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Status: {{ $user->status == 1 ? 'Aktif' : ($user->status == 2 ? 'Banned' : 'Tidak Aktif') }}</p>
<p>Role: {{ $user->roles[0]->name }}</p>
<p>RT: {{ $user->rt }}</p>
<p>RW: {{ $user->rw }}</p>
<p>Alamat: {{ $user->alamat }}</p>
<p>Foto: {{ $user->foto }}</p>

<a href="{{ route('kelola-pengguna.index') }}">Kembali</a>
