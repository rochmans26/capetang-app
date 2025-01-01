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
                        <span id="cart-item-count"
                            class="position-absolute top-0 start-100 translate-middle bg-danger text-white border border-light rounded-circle"
                            style="width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                            0 <!-- Nilai default -->
                        </span>
                    </div>

                    <ul class="dropdown-menu p-2" id="cart-dropdown">
                        <!-- Dynamic content will be injected here -->
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
                            <img src="{{ $item->image_url }}" class="card-img-top rounded-top" alt="{{ $item->image_url }}">
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
                                        action="{{ route('users.direct-checkout', [
                                            'id_item' => $item->id,
                                            'id_user' => request()->user()->id,
                                        ]) }}"
                                        method="POST" class="flex-grow-1">
                                        @csrf

                                        <button type="submit" class="btn btn-primary w-100">Checkout</button>
                                    </form>

                                    <a href="javascript:void(0)" class="btn btn-warning w-100 flex-grow-1"
                                        data-bs-toggle="modal" data-bs-target="#modal-keranjang"
                                        onclick="populateCartModal(
                                            {{ $item->id }},
                                            '{{ $item->image_url }}',
                                            '{{ $item->nama_item }}',
                                            '{{ $item->deskripsi_item }}',
                                            {{ $item->point_item }},
                                            {{ $item->stok_item }})">
                                        Masukan Keranjang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Masukan Keranjang Jumlah --}}
                    <div class="modal fade" id="modal-keranjang" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Masukan Jumlah Item
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center">
                                        <div class="card">
                                            <img class="card-img-top" id="modal-item-image">
                                            <div class="card-body">
                                                <h5 class="card-title" id="modal-item-name"></h5>
                                                <p class="card-text" id="modal-item-description"></p>
                                                <p class="card-text">Poin: <span id="modal-item-points"></span></p>
                                                <small class="badge text-bg-success" id="modal-item-stock"></small>
                                            </div>
                                            <hr>
                                            <div class="container">
                                                <form
                                                    action="{{ route('users.add-to-cart', ['id_user' => request()->user()->id]) }}"
                                                    method="post" class="mx-2 mb-1" id="cart-form">
                                                    @csrf

                                                    <input type="hidden" id="modal-item-id" name="id_item">

                                                    <div class="form-group mb-3">
                                                        <label for="jumlah_item" class="fw-bold">Jumlah</label>
                                                        <input type="number" class="form-control" id="jumlah_item"
                                                            placeholder="Masukan Jumlah" name="jumlah_item" min="1">
                                                    </div>
                                                    <div class="form-group mb-3 d-flex justify-content-center">
                                                        <input type="submit" value="Masukan Keranjang"
                                                            class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
@endsection
@section('customize-script')
    <script>
        function populateCartModal(id, image, name, description, points, stock) {
            document.getElementById('modal-item-id').value = id;
            document.getElementById('modal-item-image').setAttribute('src', image); // Set image src
            document.getElementById('modal-item-name').innerText = name;
            document.getElementById('modal-item-description').innerText = description;
            document.getElementById('modal-item-points').innerText = points + " Poin";
            document.getElementById('modal-item-stock').innerText = "Stok: " + stock;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cartDropdown = document.getElementById('cart-dropdown');
            const cartItemCount = document.getElementById('cart-item-count'); // Badge element

            // Fungsi untuk Memuat Data Cart
            const loadCart = async () => {
                try {
                    // Ambil data dari endpoint viewCart
                    const response = await fetch('/users/cart', {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    if (!response.ok) {
                        throw new Error('Failed to fetch cart data');
                    }

                    const data = await response.json();

                    // Bersihkan dropdown sebelum diisi ulang
                    cartDropdown.innerHTML = '';
                    let totalItems = 0; // Hitung jumlah item di keranjang

                    // Periksa apakah ada data cart
                    if (!data.cart || !data.cart.length) {
                        cartItemCount.textContent = '0'; // Set badge ke 0
                        cartDropdown.innerHTML = `
                    <li>
                        <div class="card mx-1 mb-2 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between p-2">
                                <div class="d-flex align-items-center">
                                    <div class="me-1">
                                        <h6 class="m-0 fw-bold">Keranjang Kosong</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>`;
                        return;
                    }

                    // Iterasi data cart
                    let totalPoints = 0;
                    data.cart[0].item.forEach(item => {
                        const jumlahPoin = item.point_item * item.pivot.jumlah_item;
                        totalPoints += jumlahPoin;
                        totalItems += item.pivot.jumlah_item; // Tambahkan jumlah item ke total

                        const itemHtml = `
                    <li>
                        <div class="card mx-1 mb-2 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between p-2">
                                <div class="d-flex align-items-center">
                                    <img src="${item.image_url}" alt="${item.image_url}" width="50" height="50" class="me-2 rounded">
                                    <div class="me-1">
                                        <h6 class="m-0 fw-bold">${item.nama_item}</h6>
                                        <p class="m-0 text-muted">Poin: ${item.point_item}</p>
                                        <p class="m-0 text-muted">Jumlah: ${item.pivot.jumlah_item}</p>
                                        <p class="m-0 text-muted">Jumlah Poin: ${jumlahPoin}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-sm me-2">
                                        <i class="bi bi-arrow-left-right"></i>
                                    </button>

                                    <form action="/users/remove-from-cart/${item.id}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>`;
                        cartDropdown.innerHTML += itemHtml;
                    });

                    // Perbarui badge jumlah item
                    cartItemCount.textContent = totalItems;

                    // Tambahkan Total Poin
                    const totalHtml = `
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-bg-success p-2 rounded">Total Poin</h5>
                                <hr>
                                <p class="card-text fs-3 d-flex align-items-center justify-content-center">
                                    <span class="ms-2 me-2">
                                        <i class="bi bi-coin text-warning"></i>
                                    </span>
                                    ${totalPoints} Poin
                                </p>
                                <a href="{{ route('users.view-checkout-cart') }}" class="btn btn-primary">Checkout</a>
                            </div>
                        </div>`;
                    cartDropdown.innerHTML += totalHtml;
                } catch (error) {
                    console.error('Error loading cart:', error);
                    cartDropdown.innerHTML = `
                        <li>
                            <div class="card mx-1 mb-2 shadow-sm">
                                <div class="d-flex align-items-center justify-content-between p-2">
                                    <div class="d-flex align-items-center">
                                        <div class="me-1">
                                            <h6 class="m-0 fw-bold text-danger">Gagal Memuat Keranjang</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>`;
                    cartItemCount.textContent = '0'; // Jika error, set badge ke 0
                }
            };

            // Panggil fungsi loadCart
            loadCart();
        });
    </script>
@endsection
