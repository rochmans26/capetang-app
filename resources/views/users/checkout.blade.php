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
                    Checkout
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

            <div class="container">
                <div class="py-5 text-center">
                    {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72"
                        height="57"> --}}
                    <h2>Checkout</h2>
                    {{-- <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required
                        form group has a validation state that can be triggered by attempting to submit the form without
                        completing it.</p> --}}
                </div>

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </h4>
                        <ul class="list-group mb-3">
                            @if (session('data'))
                                <!-- Item List -->
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <!-- Item Image -->
                                        <img src="{{ asset('img/sample-item-card.jpg') }}" alt="Sample Item" width="50"
                                            height="50" class="me-2 rounded">

                                        <!-- Item Details -->
                                        <div class="flex-grow-1">
                                            <h6 class="m-0 fw-bold">{{ session('data.item.nama_item') }}</h6>
                                            <p class="m-0 text-muted">Poin: {{ session('data.item.point_item') }}</p>
                                        </div>

                                        <!-- Quantity and Points -->
                                        <div class="text-end">
                                            <table border="0">
                                                <tr>
                                                    <td>Jumlah Item:</td>
                                                    <td>{{ session('data.quantity') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Poin:</td>
                                                    <td>
                                                        &nbsp;
                                                        {{ session('data.item.point_item') * session('data.quantity') }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                <!-- Total -->
                                <li class="list-group-item d-flex justify-content-between text-bg-primary">
                                    <span>Total Poin</span>
                                    <strong>{{ session('data.total') }} Poin</strong>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <p class="text-muted text-center">Keranjang kosong.</p>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Data Penerima</h4>
                        <form class="" novalidate action="{{ route('users.checkout-proses') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="firstName" placeholder=""
                                        value="{{ session('data.user.name') }}" disabled>
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="lastName" placeholder=""
                                        value="{{ session('data.user.email') }}" disabled>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" placeholder="Alamat" disabled
                                        value="{{ session('data.user.alamat') }}">
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="same-address">
                                <label class="form-check-label" for="same-address">Ambil barang ke Bank Unit</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="save-info">
                                <label class="form-check-label" for="save-info">Diantar ke rumah (Siapkan uang ongkos kirim
                                    sebesar Rp. 15.000,- Kepada Petugas)</label>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
