<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title>PuertoRepuesto</title>

    <link
        href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/ion.rangeSlider.skinFlat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.bxslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/media.css') }}">
    @yield('css')
</head>

<body>
    <!-- Header - start -->
    <header class="header">
        <!-- Logo, Shop-menu - start -->
        <div class="header-middle">
            <div class="container header-middle-cont">
                <div class="toplogo">
                    <a href="{{ route('frontend.index') }}">
                        <img src="{{ asset('assets/frontend/img/logo.png') }}" alt="Logo PuertoRepuesto"
                            style="filter: drop-shadow(2px 2px 4px #222);">
                    </a>
                </div>
                <div class="shop-menu">
                    <ul>
                        @if (auth()->check())
                            @if (auth()->user()->role == 'customer')
                                <li class="topauth">
                                    <a href="{{ route('frontend.my_account.view') }}">
                                        <i class="fa fa-lock"></i>
                                        <span class="shop-menu-ttl">Mi cuenta</span>
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="shop-menu-ttl">Salir</span>
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li class="h-cart">
                                    <a href="{{ route('backend.index') }}">
                                        <i class="fa fa-lock"></i>
                                        <span class="shop-menu-ttl">Administracion</span>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="topauth">
                                <a href="{{ route('customer.registerView') }}">
                                    <i class="fa fa-lock"></i>
                                    <span class="shop-menu-ttl">Registrate</span>
                                </a>
                                <a href="{{ route('customer.loginView') }}">
                                    <span class="shop-menu-ttl">Entrar</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <div class="h-cart">
                                <a href="{{ route('frontend.cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="shop-menu-ttl">Carrito</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Logo, Shop-menu - end -->

        <!-- Topmenu - start -->
        <div class="header-bottom">
            <div class="container">
                <nav class="topmenu">

                    <!-- Catalog menu - start -->
                    <div class="topcatalog">
                        <a class="topcatalog-btn" href="#">Categorías</a>
                        @if ($categories->count())
                            <ul class="topcatalog-list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('frontend.products.by_category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- Catalog menu - end -->

                    <!-- Main menu - start -->
                    <button type="button" class="mainmenu-btn">Menu</button>

                    <ul class="mainmenu">
                        <li>
                            <a href="{{ route('frontend.index') }}">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.products.index') }}">
                                Productos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.about_us') }}">
                                Nosotros
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.contact') }}">
                                Contacto
                            </a>
                        </li>
                    </ul>
                    <!-- Main menu - end -->

                    <!-- Search - start -->
                    <div class="topsearch">
                        <a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
                        <form class="topsearch-form" action="{{ route('frontend.products.index') }}" method="GET">
                            <input name="search" type="text" placeholder="Buscar...">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Search - end -->

                </nav>
            </div>
        </div>
        <!-- Topmenu - end -->

    </header>
    <!-- Header - end -->


    <!-- Main Content - start -->
    <main>
        <section class="container">
            @yield('content')
        </section>
    </main>
    <!-- Main Content - end -->


    <!-- Footer - start -->
    <footer class="footer-wrap" style="position:fixed; bottom:0; width:100%;">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <ul class="social-icons nav navbar-nav">
                        <li>
                            <a href="http://facebook.com/" rel="nofollow" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://twitter.com/" rel="nofollow" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://instagram.com/" rel="nofollow" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright">
                        <i>PuertoRepuesto</i> ©
                        {{ Carbon\Carbon::now()->year }}
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- Footer - end -->


    <!-- jQuery plugins/scripts - start -->
    <script src="{{ asset('assets/frontend/js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/fancybox/fancybox.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/swiper.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jQuery.Brazzers-Carousel.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    @yield('js')
</body>

</html>
