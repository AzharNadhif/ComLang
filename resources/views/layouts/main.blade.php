<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title', 'Comot Langsung')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/shirt3.ico') }}">

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
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


        @stack('styles') <!-- Option to add custom styles for specific pages -->
    </head>
    <body>

    <!-- Header area start -->
    <header class="header-area">
        <div class="gota_bottom position-relative">
            <div class="container-fluid">
                <div class="row align-items-center">
<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 d-none d-sm-block">
    <div class="gota_cart_10">
        @if(session('user_logged_in'))
            <a href="{{ route('user.profile') }}">
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
    </header>
    <!-- Header area end -->

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
@endif
    <!-- Main Content Area -->
<main class="max-w-4xl mx-auto mt-4 px-4">
    @yield('content') <!-- Dynamic content for each page -->
</main>


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
    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/one-page-nav-min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/countdown.js"></script>
    <script src="assets/js/ajax-form.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.scrollUp.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
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
    
    @stack('scripts') <!-- Option to add custom scripts for specific pages -->
    </body>
</html>
