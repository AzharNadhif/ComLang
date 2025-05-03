@extends('layouts.main')

@section('content')
<!-- checkout area start -->
<div class="categories_area pt-85 pb-150">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="section-wrapper text-center mb-50">
                    <h2 class="section-title">Order Details</h2>
                    <p>Fill in your shipping information correctly</p>
                </div>
            </div>
        </div>

        <div class="row g-5 align-items-stretch">
            <!-- Kiri: Produk -->
            <div class="col-lg-6 d-flex">
                <div class="product w-100 bg-white rounded shadow-sm p-4 d-flex flex-column">
                    <div class="product__thumb mb-3 text-center">
                        <img src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;">
                    </div>
                    <div class="product__content mt-auto text-center">
                        <span class="badge bg-danger text-white mb-2">{{ $produk->kategori->kategori ?? 'Jersey' }}</span>
                        <h4 class="fw-bold">{{ $produk->nama_produk }}</h4>
                        <p class="text-danger fs-5 fw-semibold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Kanan: Form -->
            <div class="col-lg-6 d-flex">
                <div class="checkout-form bg-white rounded shadow-sm p-4 w-100 d-flex flex-column">
                    <h4 class="mb-4">Shipping Information</h4>

                    <form action="{{ route('checkout.simpan') }}" method="POST" enctype="multipart/form-data" class="mt-auto">
                        @csrf
                        <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">

                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Whatsapp Number</label>
                            <input type="text" name="whatsapp" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="kode_pos" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="alamat" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="d-flex gap-3 pt-3">
                            <button type="submit" class="btn btn-danger">Checkout</button>
                            <a href="{{ route('shop') }}" class="btn btn-outline-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->


@endsection
