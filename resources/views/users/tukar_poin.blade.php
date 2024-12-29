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
                    Tukar Poin
                </h1>
                <div class="d-flex align-items-center justify-content-end gap-3">
                    <!-- Tombol Kembali -->
                    <a href="javascript:history.back()" class="btn btn-warning d-inline-flex align-items-center px-3 py-2"
                        role="button" title="Kembali ke halaman sebelumnya" aria-label="Kembali">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Back
                    </a>
                    {{-- List of Keranjang --}}
                    <!-- Icon Keranjang -->
                    <div class="position-relative d-inline-block" data-bs-toggle="dropdown">
                        <!-- Tombol Keranjang -->
                        <a href="#"
                            class="text-decoration-none d-inline-flex align-items-center btn btn-light dropdown-toggle"
                            aria-expanded="false">
                            <i class="bi bi-cart-fill text-success fs-5"></i>
                        </a>
                        <!-- Badge di Sudut Kanan Atas -->
                        <span
                            class="position-absolute top-0 start-100 translate-middle bg-danger text-white border border-light rounded-circle"
                            style="width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                            4 <!-- Ganti angka ini sesuai jumlah item -->
                        </span>
                    </div>

                    <ul class="dropdown-menu p-2">
                        <li>
                            <div class="card mx-1 mb-2 shadow-sm">
                                <!-- Konten Item dalam Satu Baris -->
                                <div class="d-flex align-items-center justify-content-between p-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/sample-item-card.jpg') }}" alt="Sample Item" width="50"
                                            height="50" class="me-2 rounded">
                                        <div class="me-1">
                                            <h6 class="m-0 fw-bold">Nama Item</h6>
                                            <p class="m-0 text-muted">Poin: 2000</p>
                                            <p class="m-0 text-muted">Jumlah: 1</p>
                                            <p class="m-0 text-muted">Jumlah Poin: 2000</p>
                                        </div>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary btn-sm me-2">
                                            <i class="bi bi-arrow-left-right"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="card mx-1 mb-2 shadow-sm">
                                <!-- Konten Item dalam Satu Baris -->
                                <div class="d-flex align-items-center justify-content-between p-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('img/sample-item-card.jpg') }}" alt="Sample Item" width="50"
                                            height="50" class="me-2 rounded">
                                        <div class="me-1">
                                            <h6 class="m-0 fw-bold">Nama Item</h6>
                                            <p class="m-0 text-muted">Poin: 2000</p>
                                            <p class="m-0 text-muted">Jumlah: 2</p>
                                            <p class="m-0 text-muted">Jumlah Poin: 4000</p>
                                        </div>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary btn-sm me-2">
                                            <i class="bi bi-arrow-left-right"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-bg-success p-2 rounded">Total Poin</h5>
                                <hr>
                                <p class="card-text fs-3 d-flex align-items-center justify-content-center">
                                    <span class="ms-2 me-2">
                                        <i class="bi bi-coin text-warning"></i>
                                    </span>
                                    6000 Poin
                                </p>
                                {{-- <a href="{{ route('user-checkout') }}" class="btn btn-primary">Checkout</a> --}}
                            </div>
                        </div>
                    </ul>
                </div>
                {{-- End of Keranjang List --}}
            </div>
            <hr>
            {{-- Daftar Item --}}
            <div class="row">
                @foreach ($listItem as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
                            <img src="{{ asset('img/sample-item-card.jpg') }}" class="card-img-top rounded-top"
                                alt="Nama Item">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold">{{ $item->nama_item }}</h5>
                                <small class="text-muted">Poin Item</small>
                                <p class="card-text d-flex align-items-center fw-bold fs-4 mt-2">
                                    <span class="me-2">
                                        <i class="bi bi-coin text-warning"></i>
                                    </span>
                                    {{ $item->point_item }} Poin
                                </p>
                                <small class="text-muted">Deskripsi Item</small>
                                <p class="card-text mt-2">
                                    {{ $item->deskripsi_item }}
                                </p>
                                <small class="badge bg-success">Stok: {{ $item->stok_item }}</small>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex gap-2">
                                    <form
                                        action="{{ route('users.checkout-store', [
                                            'id_item' => $item->id,
                                            'id_user' => request()->user()->id,
                                        ]) }}"
                                        method="POST" class="flex-grow-1">
                                        @csrf

                                        <button type="submit" class="btn btn-primary w-100">Checkout</button>
                                    </form>

                                    <a href="{{ route('users.cart') }}" class="btn btn-warning w-100 flex-grow-1"
                                        data-bs-toggle="modal" data-bs-target="#modal-keranjang">
                                        Masukan Keranjang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- End Of Daftar Item --}}
        </div>
    </div>
    {{-- end of header --}}

    {{-- Modal Masukan Keranjang Jumlah --}}
    <!-- Modal -->
    <div class="modal fade" id="modal-keranjang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Masukan Jumlah Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="card">
                            <img src="{{ asset('img/sample-item-card.jpg') }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Nama Item</h5>
                                <p class="card-text">Deskripsi Item</p>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <small class="badge text-bg-success">Stok: 8</small>
                            </div>
                            <hr>
                            <div class="container">
                                <form action="" method="post" class="mx-2 mb-1">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="inputJumlah" class="fw-bold">Jumlah</label>
                                        <input type="number" class="form-control" id="inputJumlah"
                                            placeholder="Masukan Jumlah">
                                    </div>
                                    <div class="form-group mb-3 d-flex justify-content-center">
                                        <input type="submit" value="Masukan Keranjang" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customize-script', '')
