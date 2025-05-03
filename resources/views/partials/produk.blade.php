@foreach ($produks as $produk)
    <div class="col-xl-4">
        <div class="product product-4">
            <div class="product__thumb">
                <a href="#">
                    <img class="product-primary" src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 300px; object-fit: cover;">
                    <img class="product-secondary" src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                </a>
                <div class="product-info mb-10">
                    <div class="product_category">
                        <span>{{ $produk->kategori->kategori ?? '-' }}</span>
                    </div>
                    <div class="product_rating">
                        <a href="#"><i class="fal fa-dollar-sign fw-bold" style="color: #85BB65;"></i></a>
                        <a href="#"><i class="fal fa-dollar-sign fw-bold" style="color: #85BB65;"></i></a>
                        <a href="#"><i class="fal fa-dollar-sign fw-bold" style="color: #85BB65;"></i></a>
                        <a href="#"><i class="fal fa-dollar-sign fw-bold"></i></a>
                        <a href="#"><i class="fal fa-dollar-sign fw-bold"></i></a>
                    </div>
                </div>
                <div class="product__name">
                    <h4><a href="#">{{ $produk->nama_produk }}</a></h4>
                    <div class="pro-price">
                        <p class="p-absoulute pr-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <a class="p-absoulute pr-2" href="#">add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach