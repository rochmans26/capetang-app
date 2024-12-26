<h1>Detail Role</h1>

<p>ID: {{ $role->id }}</p>
<p>Nama Role: {{ $role->name }}</p>
<p>Deskripsi: {{ $role->description }}</p>
<p>Permissions:</p>
@foreach ($role->permissions as $permission)
    {{ $permission->description }} <br>
@endforeach

<br>
<a href="{{ route('role.index') }}">Kembali</a>
