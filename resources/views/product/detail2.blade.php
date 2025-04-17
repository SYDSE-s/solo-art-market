@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detailProduct.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('content')
    @include('components.navbar')

    @php
        $subtotal = $product->price * 1000;
        $ongkir = 5000;
        $pajak = $subtotal * 0.05;
        $total = $subtotal + $ongkir + $pajak;
    @endphp

    <div class="container my-4">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="{{ asset('product_photo/' . $product->product_photo) }}" class="product-main-img mb-3"
                    style="width: 387px; height: 387px;" alt="Aquarium Hias">
                {{-- <div class="d-flex gap-2">
                    <img src="{{ asset('product_photo/' . $product->product_photo) }}" class="product-img-thumbnail"
                        alt="thumb1">
                    <img src="{{ asset('product_photo/' . $product->product_photo) }}" class="product-img-thumbnail"
                        alt="thumb2">
                    <img src="{{ asset('product_photo/' . $product->product_photo) }}" class="product-img-thumbnail"
                        alt="thumb3">
                </div> --}}
            </div>

            <div class="col-md-5">
                <div class="card rounded-2" style="background-color: #IEIEI">
                    <div class="card-body">
                        <h4 class="fw-bold fs-3">{{ $product->name }}</h4>
                        <h5 class="fw-bold fs-5">Rp{{ $product->price }}</h5>
                    </div>
                </div>
                <div class="card my-3 rounded-2">
                    <div class="card-body">
                        <p class="fw-bold mb-1 fs-5">Deskripsi Produk :</p>
                        <p>{{ $product->description }}
                        </p>
                    </div>
                </div>

                <div class="card mb-4 rounded-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center p-2 gap-3">
                            <img src="https://i.pinimg.com/736x/eb/76/a4/eb76a46ab920d056b02d203ca95e9a22.jpg"
                                class="rounded-circle" style="width: 60px; height: 60px" alt="Seller">
                            <div>
                                <strong>Ahmad Kamaludin</strong><br><small>18 Produk</small>
                            </div>
                            <a href="#" class="btn btn-danger ms-auto">Kunjungi</a>
                        </div>
                    </div>
                </div>

                <div class="card mb-3 rounded-2">
                    <div class="card-body">
                        <h5 class="fw-bold">Detail produk</h5>
                        <div class="ms-2 mt-2">
                            <p class="mb-1">Stok produk</p>
                            <div class="d-flex align-items-center gap-1">
                                <i class="bx bx-package bx-sm"></i>
                                <p class="mb-0">20</p>
                            </div>

                            <p class="mb-1 mt-2">Dikirim dari</p>
                            <div class="d-flex align-items-center gap-1">
                                <i class="bx bx-current-location bx-sm"></i>
                                <p class="mb-0">Banjarsari, Kota Surakarta</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <p class="fw-semibold mb-3">Rincian belanjamu</p>

                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $product->name }}</span>
                            <span>1x</span>
                        </div>

                        <p class="text-muted small mb-1">Stok : 100</p>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Jumlah</span>
                            <button class="btn btn-outline-secondary" id="minusBtn" type="button">−</button>
                            <input type="text" id="quantity" class="form-control text-center" value="1" readonly>
                            <button class="btn btn-outline-secondary" id="plusBtn" type="button">+</button>
                        </div>

                        <div class="p-2 rounded-1 mb-3" style="background-color: #FCEAE9;">
                            <div class="d-flex justify-content-between">
                                <span><strong>Total :</strong></span>
                                <span><strong id="totalHarga">Rp45.000</strong></span>
                            </div>
                        </div>

                        <button class="btn btn-danger w-100 rounded-2">Beli Sekarang</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5">
            <h5 class="fw-bold mb-2 fs-5">Produk lain dari toko</h5>
            <div class="row gy-5 gx-1">
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card rounded-2" style="width: 265px; height: 265px;">
                        <img src="https://i.pinimg.com/736x/85/0d/b1/850db18f60cf29b1860c4950246612f1.jpg"
                            class="card-img-top p-2"
                            style="height: 177px; width: 100%; border-radius: 6px; object-fit: cover; object-position: center;"
                            alt="barang">

                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p style="font-size: 15; font-weight: 600;">Guci Keramik</p>
                                <p style="font-weight: 600;">Rp95.000</p>
                            </div>
                            <p>Klik untuk detail</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const plusBtn = document.getElementById('plusBtn');
        const minusBtn = document.getElementById('minusBtn');
        const quantityInput = document.getElementById('quantity');
        const totalHargaEl = document.getElementById('totalHarga');

        let quantity = 1;
        const hargaPerItem = {{ $product->price * 1000 }}; // Karena kamu kalikan 1000

        function formatRupiah(angka) {
            return 'Rp' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateTotal() {
            const total = hargaPerItem * quantity;
            totalHargaEl.textContent = formatRupiah(total);
        }

        plusBtn.addEventListener('click', () => {
            quantity++;
            quantityInput.value = quantity;
            updateTotal();
        });

        minusBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;
                updateTotal();
            }
        });

        // Inisialisasi
        updateTotal();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
