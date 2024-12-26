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
                        <h3 class="text-body-emphasis">327UED32138321</h3>
                        <small class="text-muted">Nama Penerima:</small>
                        <h3 class="text-body-emphasis">Rochman Setiono</h3>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Tanggal Transaksi:</small>
                        <h3 class="text-body-emphasis">25 Desember 2024</h3>
                        <small class="text-muted">Alamat Penerima:</small>
                        <h5 class="text-body-emphasis">Komp. Cibogo Indah No. 36 A RT01/RW017, Desa Cangkuang Kulon, Kec.
                            Dayeuhkolot, Kab. Bandung - 40239</h5>
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
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Item Image -->
                                        <img src="{{ asset('img/sample-item-card.jpg') }}" alt="Sample Item" width="50"
                                            height="50" class="me-2 rounded">
                                        <!-- Item Details -->
                                        <div class="flex-grow-1">
                                            <a href="#">
                                                <h6 class="m-0 fw-bold">Nama Item</h6>
                                            </a>
                                            <p class="m-0 text-muted">Poin: 2000</p>
                                        </div>
                                    </div>
                                </td>
                                <td>2</td>
                                <td>4000 Poin</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Item Image -->
                                        <img src="{{ asset('img/sample-item-card.jpg') }}" alt="Sample Item" width="50"
                                            height="50" class="me-2 rounded">
                                        <!-- Item Details -->
                                        <div class="flex-grow-1">
                                            <a href="#">
                                                <h6 class="m-0 fw-bold">Nama Item</h6>
                                            </a>
                                            <p class="m-0 text-muted">Poin: 2000</p>
                                        </div>
                                    </div>
                                </td>
                                <td>1</td>
                                <td>2000 Poin</td>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Total Poin Tukar : </th>
                                <th>6000 Poin</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Tipe Pengambilan : </th>
                                <th>Diantar ke rumah (Siapkan uang ongkos kirim
                                    sebesar Rp. 15.000,- Kepada Petugas)</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Status Transaksi : </th>
                                <th>Barang Belum Diterima Penerima</th>
                            </tr>
                        </tbody>
                    </table>
                    <small class="text-muted">Bukti Penyerahan:</small>
                    <h3 class="text-body-emphasis">Belum ada bukti penyerahan</h3>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('customize-script', '')
