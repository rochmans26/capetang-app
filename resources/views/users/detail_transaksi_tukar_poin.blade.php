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
                <h1 class="d-flex align-items-center m-0">
                    <i class="bi bi-arrow-left-right fs-1 me-2 text-success"></i>
                    Detail Transaksi Tukar Poin
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('users.riwayat-tukar-poin') }}"
                        class="btn btn-warning d-inline-flex align-items-center px-3 py-2" role="button"
                        title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                </div>
            </div>
            <hr>

            <div class="container">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted">Kode Transaksi:</small>
                        <h3 class="text-body-emphasis">TRX-{{ $transaction->id }}</h3>
                        <small class="text-muted">Nama Penerima:</small>
                        <h3 class="text-body-emphasis">{{ $transaction->user->name }}</h3>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Tanggal Transaksi:</small>
                        <h3 class="text-body-emphasis">{{ $transaction->tgl_transaksi }}</h3>
                        <small class="text-muted">Alamat Penerima:</small>
                        <h5 class="text-body-emphasis">{{ $transaction->user->alamat }}</h5>
                    </div>
                </div>

                <small class="text-muted">Detail Item:</small>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Item</th>
                                <th scope="col">Jumlah Item</th>
                                <th scope="col">Jumlah Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->item as $item)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Item Image -->
                                            <img src="{{ $item->image_url }}" alt="{{ $item->image_url }}" width="50"
                                                height="50" class="me-2 rounded">
                                            <!-- Item Details -->
                                            <div class="flex-grow-1">
                                                <a href="#">
                                                    <h6 class="m-0 fw-bold">{{ $item->nama_item }}</h6>
                                                </a>
                                                <p class="m-0 text-muted">Poin: {{ $item->point_item }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->pivot->jumlah_item }}</td>
                                    <td>{{ $item->point_item * $item->pivot->jumlah_item }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <small class="text-muted">Bukti Penyerahan:</small><br>
                    @if ($transaction->bukti_penyerahan)
                        <img src="{{ $transaction->image_url }}" alt="{{ $transaction->image_url }}"
                            class="img-fluid rounded mt-2" width="350" height="350">
                    @else
                        <h3 class="text-body-emphasis">Belum ada bukti penyerahan</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
