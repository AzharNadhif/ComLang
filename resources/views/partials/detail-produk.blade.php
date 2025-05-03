@extends('layouts.main')

@section('content')
<!-- product details area start -->
<!-- product details area start -->
<div class="product__details-area pt-85 pb-120">
    <div class="container">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div class="product__details-thumb mb-30 text-center">
                    <img src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                         class="img-fluid rounded shadow" style="max-width: 80%; height: auto;">
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="product__details-content mb-30">
                    <!-- Kategori -->
                    <div class="product_category mb-2">
                        <span class="badge bg-danger text-white px-3 py-1">
                            {{ $produk->kategori->kategori ?? '-' }}
                        </span>
                    </div>

                    <!-- Nama Produk -->
                    <h2 class="product-title mb-3">{{ $produk->nama_produk }}</h2>

                    <!-- Harga Produk -->
                    <div class="product_price mb-4">
                        <span class="text-danger h4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                    </div>

                    <!-- Tombol -->
                    <div class="d-flex gap-2 mb-4">
                        @if(session('user_logged_in'))
                            <a href="{{ route('checkout.show', $produk->id_produk) }}" class="btn btn-danger">
                               Checkout
                            </a>
                            <form action="{{ route('keranjang.tambah', $produk->id_produk) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn border border-danger text-danger bg-white">
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="{{ route('user.login.form') }}" class="btn btn-danger">
                                Checkout
                            </a>
                            <a href="{{ route('user.login.form') }}" class="btn border border-danger text-danger bg-white">
                                Add to Cart
                            </a>
                        @endif
                    </div>

                    <!-- Deskripsi -->
                    <div class="product-description mt-4">
                        <h4 class="mb-2">Product Description</h4>
                        <p class="text-muted">{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product details area end -->

<!-- product details area end -->

@endsection
