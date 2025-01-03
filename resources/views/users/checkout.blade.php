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
                    <a href="{{ route('users.penukaran-poin') }}"
                        class="btn btn-warning d-inline-flex align-items-center px-3 py-2" role="button"
                        title="Kembali ke halaman sebelumnya" aria-label="Kembali">
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
                    @if ($cart)
                        <div class="col-md-5 col-lg-4 order-md-last">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Your cart</span>
                                <span class="badge bg-primary rounded-pill">1</span>
                            </h4>
                            <ul class="list-group mb-3">
                                <!-- Item List -->
                                @foreach ($cart->item as $item)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <!-- Item Image -->
                                            <img src="{{ $item->image_url }}" alt="{{ $item->image_url }}" width="50"
                                                height="50" class="me-2 rounded">

                                            <!-- Item Details -->
                                            <div class="flex-grow-1">
                                                <h6 class="m-0 fw-bold">{{ $item->nama_item }}</h6>
                                                <p class="m-0 text-muted">Poin: {{ $item->point_item }}</p>
                                            </div>

                                            <!-- Quantity and Points -->
                                            <div class="text-end">
                                                <table border="0">
                                                    <tr>
                                                        <td>Jumlah Item:</td>
                                                        <td>{{ $item->pivot->jumlah_item }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumlah Poin:</td>
                                                        <td>
                                                            &nbsp;
                                                            {{ $item->point_item * $item->pivot->jumlah_item }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <!-- Total -->
                                <li class="list-group-item d-flex justify-content-between text-bg-primary">
                                    <span>Total Poin</span>
                                    <strong>{{ $cart->total_transaksi }} Poin</strong>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-7 col-lg-8">
                            <h4 class="mb-3">Data Penerima</h4>
                            <form class="" novalidate action="{{ route('users.checkout-cart') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="firstName" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="firstName" placeholder=""
                                            value="{{ auth()->user()->name }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="lastName" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="lastName" placeholder=""
                                            value="{{ auth()->user()->email }}" disabled>
                                    </div>

                                    <div class="col-12">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="address" placeholder="Alamat"
                                            disabled value="{{ auth()->user()->alamat }}">
                                    </div>
                                </div>

                                <hr class="my-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input option-checkbox" id="ambil-barang"
                                        name="tipe_pengambilan" value="1" checked>
                                    <label class="form-check-label" for="kirim-barang">Ambil barang ke Bank Unit</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input option-checkbox" id="diantar-rumah"
                                        name="tipe_pengambilan" value="2">
                                    <label class="form-check-label" for="diantar-rumah">Diantar ke rumah (Siapkan uang
                                        ongkos kirim sebesar Rp. 15.000,- kepada petugas)</label>
                                </div>

                                <hr class="my-4">

                                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                            </form>
                        </div>
                    @else
                        <li class="list-group-item">
                            <p class="text-muted text-center">Keranjang kosong.</p>
                        </li>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script')
    <script>
        document.querySelectorAll('.option-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelectorAll('.option-checkbox').forEach(otherCheckbox => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });
                }
            });
        });
    </script>
@endsection
