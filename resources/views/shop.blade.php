<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Comot Langsung</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/shirt3.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/futura-std-font.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
         <link rel="stylesheet" href="{{ asset('assets/css/ui.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    </head>
    <body>


    <!-- header area start -->
    <header class="header-area">
        <!-- <div class="gota_top bg-soft d-none d-sm-block">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="gota_lang">
                                <ul>
                                    <li><a href="#">usd<i class="fal fa-chevron-down"></i></a>
                                        <ul class="additional_dropdown">
                                            <li><a href="#">euro</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">english<i class="fal fa-chevron-down"></i></a>
                                        <ul class="additional_dropdown">
                                            <li><a href="#">frences</a></li>
                                            <li><a href="#">japanes</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 offset-xl-5 col-lg-6 col-md-6 col-sm-6 text-end">
                            <div class="gota_right">
                                <ul>
                                     <li><a href="cart.html">Wishlist</a></li>
                                    <li><a href="login.html">Account</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="login.html">Login & register</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <div class="gota_bottom position-relative">
            <div class="container-fluid">
                <div class="row align-items-center">
<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 d-none d-sm-block">
    <div class="gota_cart_10">
        @if(session('user_logged_in'))
            <a href="{{ route('user.profile') }}" >
                <i class="fas fa-user"></i>
                {{ \App\Models\User::find(session('user_id'))->nama }}
            </a>
        @else
            <a href="{{ route('user.login.form') }}">
                <i class="fas fa-user"></i>
                Profile
            </a>
        @endif
    </div>
</div>
                    <div class="col-xl-8 col-lg-8 col-md-4 col-sm-4">
                        <div class="sidemenu sidemenu-1 d-lg-none d-md-block">
                            <a class="open" href="#"><i class="fal fa-bars"></i></a>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('shop') }}">Shop</a></li>
                                    <li><a class="d-none d-xl-block" href="{{ route('home') }}">
                                            <img class="pl-50 pr-50" src="{{ asset('assets/img/logo/logoo.png') }}" alt="">
                                        </a>
                                    </li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('contact') }}">Contact us</a></li>
                                </ul>
                            </nav>
                        </div>
    
                    </div>
                    @php
    $userLoggedIn = session('user_logged_in');
    $keranjang = collect();
    $jumlahKeranjang = 0;
    $subtotal = 0;

    if ($userLoggedIn) {
        $keranjang = \App\Models\Keranjang::with('produk')->where('id_user', session('user_id'))->get();
        $jumlahKeranjang = $keranjang->count();
        $subtotal = $keranjang->sum(fn($item) => $item->produk->harga ?? 0);
    }
@endphp

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <div class="gota_cart gotat_cart_1 text-end">
@if ($userLoggedIn)
    <a href="javascript:void(0)" id="open-cart">
        <i class="fal fa-shopping-cart"></i>
        My Bag
        <span class="counter">({{ $jumlahKeranjang }})</span>
    </a>
@else
    <a href="{{ route('user.login.form') }}">
        <i class="fal fa-shopping-cart"></i>
        My Bag
        <span class="counter">(0)</span>
    </a>
@endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->


    <div class="offcanvas-overlay"></div>

@if (session('user_logged_in'))
    @php
        $keranjang = \App\Models\Keranjang::with('produk')
            ->where('id_user', session('user_id'))
            ->get();
        $subtotal = $keranjang->sum(fn($item) => $item->produk->harga);
    @endphp

    <!-- Cart Sidebar Start -->
    <div class="cart__sidebar">
        <div class="container">
            <div class="cart__content">
<div class="cart-text">
    <h3 class="mb-40">Shopping cart</h3>
    <div class="cart-products-wrapper" style="max-height: 420px; overflow-y: auto; overflow-x: hidden; padding-right: 20px; box-sizing: content-box; margin-bottom: 1rem;">
        @foreach ($keranjang as $item)
            <div class="add_cart_product">
                <div class="add_cart_product__thumb">
                    <img src="{{ asset('images/produk/' . $item->produk->gambar) }}" alt="">
                </div>
                <div class="add_cart_product__content">
                    <h5>{{ $item->produk->nama_produk }}</h5>
                    <p>1 × Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                    <form action="{{ route('keranjang.hapus', $item->id_keranjang) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="cart_close"><i class="fal fa-times"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

                <div class="cart-icon">
                    <i class="fal fa-times" id="close-cart"></i>
                </div>
                <div class="cart-bottom">
                    <div class="cart-bottom__text">
                        <span>Subtotal:</span>
                        <span class="end">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                        <a href="{{ route('checkout.cart.form') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-offcanvas-overlay" id="cart-overlay"></div>
    <!-- Cart Sidebar End -->
    <!-- Cart Sidebar End -->
@endif

    <!-- breadcrumb area start -->
    <div class="page-layout" data-background="assets/img/slider/f.png">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="breadcrumb-area text-center">
                        <h2 class="page-title">shop</h2>
                            <div class="breadcrumb-menu">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('shop') }}">shop</a></li>
                                </ol>
                            </nav>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- shop page start -->
    <div class="shop-page pt-85">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="sidebar">
                        <div class="product-widget">
                            <h3 class="widget-title mb-30">Product categories</h3>
<ul class="product-categories">
    <li>
        <a href="javascript:void(0)" class="filter-kategori" data-id="all">
            All Categories <span>({{ $totalProduk }})</span>
        </a>
    </li>
    @foreach($kategoriCounts as $kategori)
        <li>
            <a href="javascript:void(0)" class="filter-kategori" data-id="{{ $kategori->id_kategori }}">
                {{ $kategori->kategori }} <span>({{ $kategori->products_count }})</span>
            </a>
        </li>
    @endforeach
</ul>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-9 col-sm-12">
                    <div class="shop-top-bar position-relative">
                        <div class="showing-result">
                            <p id="jumlah-produk">Showing all {{ $totalProduk }} results</p>
                        </div>
                    </div>
<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<div class="row" id="produk-container">
    
@foreach ($produks as $produk)
    <div class="col-xl-4">
        <div class="product product-4">
            <div class="product__thumb">
                <a href="{{ route('produk.detail', $produk->id_produk) }}">
                    <img class="product-primary" src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" style="width: 100%; height: 300px; object-fit: cover;">
                    <img class="product-secondary" src="{{ asset('images/produk/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                </a>
                <div class="product-info mb-10">
                    <div class="product_category">
                        <span>{{ $produk->kategori->kategori ?? '-' }}</span>
                    </div>
                </div>
                <div class="product__name">
                    <h4><a href="#">{{ $produk->nama_produk }}</a></h4>
                    <div class="pro-price">
                        <p class="p-absoulute pr-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <form action="{{ route('keranjang.tambah', $produk->id_produk) }}" method="POST">
                            @csrf
                            @if (session('user_logged_in'))
                                <button type="submit" class="p-absoulute pr-2" style="border: none; background: none; color: #000;">add to cart</button>
                            @else
                                <a href="{{ route('user.login.form') }}" class="p-absoulute pr-2">add to cart</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- shop page end -->

    <!-- search area  -->
    <div class="search_area">
        <div class="search_close">
            <span><i class="fal fa-times"></i></span>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="search-wrapper text-center">
                        <h2>search</h2>
                        <div class="search-filtering pt-30">
                            <div class="search_tab">
                                <ul class="nav nav-tabs justify-content-center mb-55" id="fff" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                            data-bs-target="#home2" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">All categories</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                            data-bs-target="#profile2" type="button" role="tab" aria-controls="profile"
                                            aria-selected="false">Basketball</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#contact2" type="button" role="tab" aria-controls="contact"
                                            aria-selected="false">Handbag</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sportswear-tab" data-bs-toggle="tab"
                                            data-bs-target="#sportswear" type="button" role="tab" aria-controls="sportswear"
                                            aria-selected="false">Sportswear</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact3-tab" data-bs-toggle="tab"
                                            data-bs-target="#contact3" type="button" role="tab" aria-controls="contact2"
                                            aria-selected="false">Youth</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home2" role="tabpanel"
                                        >

                                    </div>
                                    <div class="tab-pane fade" id="profile2" role="tabpanel"
                                        >

                                    </div>
                                    <div class="tab-pane fade" id="contact2" role="tabpanel">

                                    </div>
                                    <div class="tab-pane fade" id="sportswear" role="tabpanel"
                                        >

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main_search">
                            <form action="#">
                                <input type="text" name="search" placeholder="search products">
                                <button class="m-search"><i class="fal fa-search d-sm-none d-md-block"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popup area start -->
    <div class="overlay"></div>
    <div class="product-popup">
            <div class="view-background">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-5">
                        <div class="quickview">
                            <div class="quickview__thumb">
                                <img src="./assets/img/quick_view/25.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-7">
                        <div class="viewcontent">
                            <div class="viewcontent__header">
                              <a href="single.html">  <h2>Brown Leather Bags</h2>
           </a>                     <a class="view_close product-p-close" href="javascript:void(0)"><i class="fal fa-times-circle"></i></a>
                            </div>
                            <div class="viewcontent__rating">
                                <i class="fal fa-star ratingcolor"></i>
                                <i class="fal fa-star ratingcolor"></i>
                                <i class="fal fa-star ratingcolor"></i>
                                <i class="fal fa-star"></i>
                            </div>
                            <div class="viewcontent__price">
                                <h4><span>$</span>99.00</h4>
                            </div>
                            <div class="viewcontent__stock">
                                <h4>Available :<span> In stock</span></h4>
                            </div>
                            <div class="viewcontent__details">
                                <p>Anlor sit amet, consectetur adipiscing elit. Fusce condimentum est lacus, non pretium risus lacinia vel. Fusce eget turpis orci.</p>
                            </div>
                            <div class="viewcontent__action">
                                <span>Qty</span>
                                <span><input type="number" placeholder="1"></span>
                                <span><a href="#">add to cart</a></span>
                                <span><i class="fal fa-heart"></i></span>
                                <span><i class="fal fa-info-circle"></i></span>
                            </div>
                            <div class="viewcontent__footer">
                                <ul>
                                    <li>Category:</li>
                                    <li>SKU:</li>
                                    <li>Brand:</li>
                                </ul>
                                <ul>
                                    <li>Watches</li>
                                    <li>2584-MK63</li>
                                    <li>Brenda</li>  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- product popup -->
    <!-- popup area end -->

<!-- footer area start -->
<footer class="footer_area fix pt-60 pb-30">
    <div class="container">
        <div class="row gy-5">
            <!-- Contact Info -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="company__info wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
                    <h3 class="f-title">Contact Info</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li>Address: Pondok Cabe, Pamulang, South Tangerang City, Banten, Indonesia</li>
                        <li>Email: comotlangsungthrift@gmail.com</li>
                        <li>Phone: (+62) 858 1784 0877</li>
                    </ul>
                    <div class="social__media mb-30 mt-3">
                        <h3 class="f-title">Follow Us On</h3>
                        <a href="https://www.instagram.com/comotlangsung/" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <!-- Tambahan opsional kalau ingin -->
                        <!--
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        -->
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center">
                <div class="company__info text-center wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
                    <h3 class="f-title">Quick Links</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Google Maps Location -->
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                <div class="company__info wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".5s">
                    <h3 class="f-title">Our Location</h3>
                    <div class="map-responsive" style="border-radius: 8px; overflow: hidden;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.190951401463!2d106.75326497405425!3d-6.238277461019575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1dcf2cda0df%3A0x4e5edb263c9aa0f7!2sPondok%20Cabe%2C%20Pamulang%2C%20South%20Tangerang!5e0!3m2!1sen!2sid!4v1714712481789!5m2!1sen!2sid"
                            width="100%"
                            height="200"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer__bottom text-center pt-40 mt-4">
            <p>
                Copyright © <span>Comot Langsung</span>. All Rights Reserved.
                Powered by 
                <a href="https://www.instagram.com/einsteiniumproject/" target="_blank"><span>Einsteinium</span></a>
            </p>
        </div>
    </div>
</footer>
<!-- footer area end -->


		<!-- JS here -->
        <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/one-page-nav-min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/jquery.meanmenu.min.js"></script>
        <script src="assets/js/ajax-form.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/ui.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/countdown.js"></script>
        <script src="assets/js/main.js"></script>

       
        <script>
document.querySelectorAll('.filter-kategori').forEach(item => {
    item.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const url = id === 'all' ? '/shop/all' : `/shop/filter/${id}`;

        fetch(url)
            .then(res => res.json())
            .then(res => {
                const container = document.querySelector('#produk-container');
                container.innerHTML = '';

                res.data.forEach(produk => {
                    container.innerHTML += `
                        <div class="col-xl-4">
                            <div class="product product-4">
                                <div class="product__thumb">
                                    <a href="/produk/${produk.id_produk}">
                                        <img class="product-primary" src="/images/produk/${produk.gambar}" alt="${produk.nama_produk}" style="width: 100%; height: 300px; object-fit: cover;">
                                        <img class="product-secondary" src="/images/produk/${produk.gambar}" alt="${produk.nama_produk}">
                                    </a>
                                    <div class="product-info mb-10">
                                        <div class="product_category">
                                            <span>${produk.kategori?.kategori || '-'}</span>
                                        </div>
                                    </div>
                                    <div class="product__name">
                                        <h4><a href="#">${produk.nama_produk}</a></h4>
                                        <div class="pro-price">
                                            <p class="p-absoulute pr-1">Rp ${parseInt(produk.harga).toLocaleString('id-ID')}</p>
                                            <a class="p-absoulute pr-2" href="/login">add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                // Update jumlah produk ditampilkan
                document.getElementById('jumlah-produk').innerText = `Showing all ${res.data.length} results`;
            });
    });
});

</script>
    <script>
function toggleCart() {
    document.getElementById('cartSidebar').classList.toggle('active');
    document.querySelector('.cart-offcanvas-overlay').classList.toggle('active');
}
</script>
    <script>
    const openCart = document.getElementById('open-cart');
    const closeCart = document.getElementById('close-cart');
    const cartSidebar = document.querySelector('.cart__sidebar');
    const cartOverlay = document.getElementById('cart-overlay');

    openCart?.addEventListener('click', () => {
        cartSidebar.classList.add('active');
        cartOverlay.classList.add('active');
    });

    closeCart?.addEventListener('click', () => {
        cartSidebar.classList.remove('active');
        cartOverlay.classList.remove('active');
    });

    cartOverlay?.addEventListener('click', () => {
        cartSidebar.classList.remove('active');
        cartOverlay.classList.remove('active');
    });
</script>






    </body>
</html>