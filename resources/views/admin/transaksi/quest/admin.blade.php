@extends('layouts.main')
@section('customize-style')
    <style>
        .full-height {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            /* Pastikan padding termasuk dalam ukuran total */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="container shadow full-height rounded">
            {{-- header --}}
            <div class="title d-flex justify-content-between align-items-center mt-3 primary-color p-3 rounded">
                <h1 class="d-flex align-items-center text-white">
                    <i class="bi bi-bookmark-check-fill fs-1 me-2 text-warning"></i>
                    Daftar Quest Approval
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Tombol Kembali -->
                    <a href="javascript:history.back()" class="btn btn-warning d-inline-flex align-items-center px-3 py-2"
                        role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
            <hr>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Quest</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usersQuest as $quest)
                            <tr>
                                <td>{{ $loop->index + 1 + ($usersQuest->currentPage() - 1) * $usersQuest->perPage() }}</td>
                                <td>{{ $quest->user_name }}</td>
                                <td>{{ $quest->quest_name }}</td>
                                <td>{{ $quest->status }}</td>
                                <td>
                                    <form
                                        action="{{ route('admin.kirim-reward-quest', ['userId' => $quest->id_user, 'questId' => $quest->id_quest]) }}"
                                        method="POST">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-primary">Set Selesai</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada quest yang menunggu approval.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $usersQuest->links() }}
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
