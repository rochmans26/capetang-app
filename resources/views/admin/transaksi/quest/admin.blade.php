@if (session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

<h1>Daftar User yang Menunggu Approval</h1>

<table>
    <thead>
        <tr>
            <th>ID User</th>
            <th>Nama User</th>
            <th>Quest</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usersQuest as $userQuest)
            @foreach ($userQuest->quest as $quest)
                @if ($quest->pivot->status === 'menunggu')
                    <tr>
                        <td>{{ $userQuest->id }}</td>
                        <td>{{ $userQuest->name }}</td>
                        <td>{{ $quest->nama_quest }}</td>
                        <td>{{ $quest->pivot->status }}</td>
                        <td>
                            <form
                                action="{{ route('kirim-reward-quest', ['userId' => $userQuest->id, 'questId' => $quest->id]) }}"
                                method="POST">
                                @csrf
                                @method('put')
                                <button type="submit">Set Selesai</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>
