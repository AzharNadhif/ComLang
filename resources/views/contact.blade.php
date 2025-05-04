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
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    </head>
    <body>


    <!-- header area start -->
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
            </div>
        </div>
    </header>
    <!-- header area end -->

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
                                <ul class="nav nav-tabs justify-content-center mb-55" id="myTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                            data-bs-target="#home2" type="button" role="tab"
                                            aria-selected="true">All categories</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                            data-bs-target="#profile2" type="button" role="tab" 
                                            aria-selected="false">Basketball</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#contact2" type="button" role="tab" 
                                            aria-selected="false">Handbag</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sportswear-tab" data-bs-toggle="tab"
                                            data-bs-target="#sportswear" type="button" role="tab"
                                            aria-selected="false">Sportswear</button>
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

    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="mobile-menu"></div>
                <div class="contact-infos mb-30">
                    <div class="contact-list mb-30">
                        <h4>Office Address</h4>
                        <p>123/A, Miranda City Likaoli
                            Prikano, Dope</p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Phone Number</h4>
                        <p>+0989 7876 9865 9</p>
                        <p>+(090) 8765 86543 85</p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Email Address</h4>
                        <p>info@example.com</p>
                        <p>example.mail@hum.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <ul class="nav nav-tabs justify-content-center mb-55" id="myTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab2" data-bs-toggle="tab"
                                            data-bs-target="#home2" type="button" role="tab"
                                            aria-selected="true">All categories</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab2" data-bs-toggle="tab"
                                            data-bs-target="#profile2" type="button" role="tab" 
                                            aria-selected="false">Basketball</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#contact2" type="button" role="tab" 
                                            aria-selected="false">Handbag</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sportswear-tab" data-bs-toggle="tab"
                                            data-bs-target="#sportswear" type="button" role="tab"
                                            aria-selected="false">Sportswear</button>
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

    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="mobile-menu"></div>
            </div>
        </div>
    </div>

    <!-- contact area start -->
    <div class="contact__area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="contact__content text-center mb-140">
                    <h2>Contact Us</h2>
                    <p>For us, the most important part of growing as a vintage thrift store <br> has been sharing what we find. Start your own journey by browsing unique pieces, following us on Instagram, or joining the community.</p>
                </div>
                </div>
            </div>
            <div class="contact-wrapper">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">
                    <div class="contactbox">
                        <div class="contactbox__heading">
                            <h5>Contact us</h5>
                            <h2>Please contact us quickly if <br>you need help.</h2>
                        </div>
                        <div class="contactbox__info pt-20">
                            <h5>Address</h5>
                            <ul>
                                <li>Pondok Cabe, Pamulang, South Tangerang City, Banten, Indonesia</li>
                                <li>Open: 8:30 am – 10:00 pm</li>
                            </ul>
                        </div>
                        <div class="contactbox__info pt-20">
                            <h5>Contacts Email:</h5>
                            <ul>
                                <li>Comotlangsungthrift@gmail.com</li>
                                <li>Phone <a href="tel:(+62)85817840877">(+62)858 1784 0877</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-md-6">
                    <div class="form">
                        <h5>write to us</h5>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="c-input-group">
                                <label>Your Email (required)</label>
                                <input type="email" name="email" required>
                            </div>
                            <div class="c-input-group">
                                <label>Subject</label>
                                <input type="text" name="subject" required>
                            </div>
                            <div class="c-input-group">
                                <label>Your Message</label>
                                <textarea name="message" required></textarea>
                            </div>
                            <div class="submit-btn">
                                <input type="submit" value="Send">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
     <!-- contact area end -->

     

         <div class="map__area">
            <div class="google-map contact-map">
                <iframe class="w-100" height="800" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.0999515452136!2d106.76122151057005!3d-6.336152593627073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69efa999f334e7%3A0xd0ce5831591c54dd!2sPondok%20Cabe%20Airport!5e1!3m2!1sen!2sid!4v1745222372503!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
         </div>

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
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/countdown.js"></script>
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
    </body>
</html>