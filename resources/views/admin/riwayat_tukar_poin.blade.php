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
            <div class="title d-flex justify-content-between align-items-center mt-3 p-3 primary-color rounded">
                <h1 class="d-flex align-items-center text-white">
                    <i class="bi bi-nintendo-switch fs-1 me-2"></i>
                    Riwayat Tukar Poin
                </h1>

                <a href="javascript:history.back()" class="btn btn-success d-inline-flex align-items-center" role="button"
                    title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back
                </a>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Point Tukar</th>
                            <th scope="col">Status Transaksi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userHistory as $history)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $history->user->name }}</td>
                                <td>{{ $history->tgl_transaksi }}</td>
                                <td>{{ $history->total_transaksi ?? '-' }}</td>
                                <td>{{ $history->status_transaksi }}</td>
                                <td>
                                    <a href="{{ route('admin.update-transaksi', $history->id) }}"
                                        class="btn btn-warning d-inline-flex align-items-center" role="button"
                                        title="Update Transaksi" aria-label="Update">
                                        <i class="bi bi-pencil-square me-2')}}"></i>
                                        Upload Bukti Penyerahan
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    {{-- end of header --}}
@endsection
@section('customize-script', '')
