<h1>Detail Role</h1>

<p>ID: {{ $role->id }}</p>
<p>Nama Role: {{ $role->nama_role }}</p>
<p>Deskripsi: {{ $role->deskripsi }}</p>

<a href="{{ route('role.index') }}">Kembali</a>
