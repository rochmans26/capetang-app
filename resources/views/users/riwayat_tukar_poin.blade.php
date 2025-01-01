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
            <div class="title d-flex justify-content-between align-items-center mt-3">
                <h1 class="d-flex align-items-center">
                    <i class="bi bi-bookmark-star-fill text-warning"></i>
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
                                <td>{{ $history->tgl_transaksi }}</td>
                                <td>{{ $history->total_transaksi ?? '-' }}</td>
                                <td>{{ $history->status_transaksi }}</td>
                                <td>
                                    <a href="{{ route('users.detail-transaksi', $history->id) }}"
                                        class="btn btn-primary d-inline-flex align-items-center" role="button"
                                        title="Detail Transaksi" aria-label="Detail">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Detail
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
