<div>
    @if (session()->has('success'))
        <div class="alert alert-success custom_alert alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger custom_alert alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('error') }}
        </div>
    @endif
    <div class="top-header py-1 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <ul class="text-start d-flex justify-content-start list-unstyled mb-0">
                        <li>
                            <i class="fa fa-phone"></i>
                            <a class="tel-no text-white" href="tel:{{ $WebsiteInformations->number }}"> {{ $WebsiteInformations->number }}</a>
                        </li>
                        <li class="email">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:{{ $WebsiteInformations->gmail }}">{{ $WebsiteInformations->gmail }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-4">
                    <ul class="list-unstyled social-icons d-flex justify-content-end mb-0">
                        <li>
                            <a href="{{ $WebsiteInformations->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{ $WebsiteInformations->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{ $WebsiteInformations->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="{{ $WebsiteInformations->instragram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="{{ $WebsiteInformations->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header-start -->
    <div class="main-navbar shadow-sm sticky-top" id="fixed">
        <div class="top-navbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 my-auto d-none d-sm-none d-xl-block">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('storage/' . $WebsiteInformations->image) }}" alt="" width="120" style="margin-left: -2px;">
                        </a>
                    </div>
                    <div class="col-xl-7 my-auto">
                        <form action="{{ route('search') }}" method="GET" class="top-search" style="margin-top: 5px;">
                            <div class="input-group">
                                <input type="search" placeholder="Search your product" value="{{old('book')}}" name="book" class="shadow-none form-control" />
                                <button type="submit" class="btn bg-serch shadow-none">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 my-auto">
                        <ul class="nav justify-content-end" style="margin-top: 5px;">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="sm-nome-only">
                                        Cart ({{ $cart_total }})
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    <span class="sm-nome-only">
                                        Sign in
                                    </span>
                                </a>
                                <ul class="dropdown-menu top-dropdown" aria-labelledby="navbarDropdown">
                                    @auth
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fa fa-user"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('all_order') }}">
                                            <i class="fa fa-list"></i>
                                            My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('customerLogout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customerlogin') }}">
                                            <i class="fas fa-lock u-s-m-r-6 color-orange"></i>
                                            Login
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('customerregistation') }}">
                                            <i class="fas fa-pen-alt u-s-m-r-6 color-orange"></i>
                                            Register
                                        </a>
                                    </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="navbar navbar-expand-xl navbar-light pe-2 px-lg-0">
                    <div class="container ps-0">
                        <button class="navbar-toggler shadow-none mt-1 pe-1 ps-0" type="button" id="btn_rhishi">
                            <i class="fas fa-bars fa-lg" style="color: #000"></i>
                        </button>
                        <a class="navbar-brand d-block d-sm-block d-xl-none" href="{{ url('/') }}">
                            <img src="{{ asset('storage/' . $WebsiteInformations->image) }}" alt="" width="100">
                        </a>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="menu-init" id="navigation2">
                                <div class="ah-lg-mode">
                                    <span class="ah-close">✕ Close</span>
                                    <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                                        <li class="has-dropdown">
                                            <a>বিষয়<i class="fas fa-angle-down u-s-m-l-6"></i></a>
                                            <span class="js-menu-toggle"></span>
                                            <ul id="js--authors-menu" class="sub-menu__dropdown-menu show">
                                                <div class="saperate row">
                                                    @foreach ($Subjects as $Subject)
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('category_product', $Subject->id) }}">{{ $Subject->name }} </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a>প্রকাশনী<i class="fas fa-angle-down u-s-m-l-6"></i></a>
                                            <span class="js-menu-toggle"></span>
                                            <ul id="js--authors-menu" class="sub-menu__dropdown-menu show">
                                                <div class="saperate row">
                                                    @foreach ($Prakasanis as $Prakasani)
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <ul>
                                                            <li><a href="{{ route('prakasani_product', $Prakasani->id) }}">{{ $Prakasani->name }} </a></li>
                                                        </ul>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a>লেখক<i class="fas fa-angle-down u-s-m-l-6"></i></a>
                                            <span class="js-menu-toggle"></span>
                                            <ul id="js--authors-menu" class="sub-menu__dropdown-menu show">
                                                <div class="saperate row">
                                                    @foreach ($Writers as $Writer)
                                                    <div class="col-12 col-md-4 col-lg-3">
                                                        <ul>
                                                            <li><a href="{{ route('writer_product', $Writer->id) }}">{{ $Writer->name }} </a></li>
                                                        </ul>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </li>
                                        <li>
                                            @foreach ($PrakasanisIsNav as $item)
                                            <a href="{{ route('prakasani_product', $item->id) }}">{{ $item->name }} </a>
                                            @endforeach
                                        </li>
                                        <li>
                                            @foreach ($SubjectsIsNav as $item)
                                            <a href="{{ route('category_product', $item->id) }}">{{ $item->name }} </a>
                                            @endforeach
                                        </li>
                                        <li>
                                            <a href="{{ route('corporate') }}">প্রাতিষ্ঠানিক অর্ডার</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('blog') }}">ব্লগ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- header-end -->
</div>
