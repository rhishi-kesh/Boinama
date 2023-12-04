<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="" type="image/x-icon">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>Boinama - Dashbord</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/feather-icon.css' }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/animate.css' }}">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/owlcarousel.css' }}">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/prism.css' }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/vendors/bootstrap.css' }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/style.css' }}">
    <link id="color" rel="stylesheet" href="{{ url('backend/') }}/{{ 'assets/css/color-1.css' }}" media="screen">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('backend/') }}/{{ 'assets/css/responsive.css' }}">
    <link rel="stylesheet" href="{{ url('backend/') }}/{{ 'assets/css/custom.css' }}">
    @stack('admin-css')
    @livewireStyles
</head>
  <body>
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper">
              <a href="{{ route('admin_dashbord') }}">
                <img class="img-fluid" src="{{ url('logo.png') }}" alt="Logo" width="90">
              </a>
            </div>
          </div>
          <div class="toggle-sidebar">
            <i class="status_toggle middle" data-feather="sidebar" id="sidebar-toggle"></i>
          </div>
          <div class="left-menu-header col">
            <ul>
              <li>
                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
              </li>
            </ul>
          </div>
          <div class="nav-right col pull-right right-menu">
            <ul class="nav-menus">
                @if (Auth::guard('admin')->user()->role == 0)
                    <li>
                        <a href="{{ route('usercreate') }}" class="btn btn-primary rounded">Add User</a>
                    </li>
                @endif
              <li>
                <div class="mode">
                    <i class="fa-regular fa-moon"></i>
                </div>
              </li>
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="onhover-dropdown">
                <div class="media profile-media">
                    <img src="{{ empty(Auth::guard('admin')->user()->profile_photo_path) ? url('images/profile.jpg') : asset('storage/' . Auth::guard('admin')->user()->profile_photo_path) }}" alt="{{ Auth::guard('admin')->user()->name }}" class="rounded-circle object-fit-cover" style="width: 35px; height: 35px; object-fit: cover;">
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="{{ route('profile') }}"><i data-feather="user"></i><span>Profile </span></a></li>
                  <li>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('adminlogout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="d-lg-none col mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
        </div>
      </div>
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <header class="main-nav">
          <div class="logo-wrapper text-center">
            <a href="{{ route('admin_dashbord') }}">
              <img class="img-fluid" src="{{ url('logo.png') }}" alt="" width="90">
            </a>
            </div>
          <div class="logo-icon-wrapper text-center">
            <a href="{{ route('admin_dashbord') }}">
              <img class="img-fluid" src="{{ url('logo.png') }}" alt="" width="90">
            </a>
          </div>
          <div class="morden-logo text-center">
            <a href="{{ route('admin_dashbord') }}">
              <img class="img-fluid" src="{{ url('logo.png') }}" alt="" width="90">
            </a>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
              <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end">
                        <span>Back</span>
                        <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                  </li>
                  <li>
                    <a class="nav-link" href="{{ url('/') }}" target="_blank">
                        <i data-feather="globe"></i>
                        <span>Visit Site</span>
                    </a>
                  </li>
                  <div class="px-4">
                    <hr>
                  </div>
                  @if (Auth::guard('admin')->user()->role == 0 || Auth::guard('admin')->user()->role == 2)
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="wind"></i>
                            <span>Orders</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('order_list') }}">Order List</a></li>
                        </ul>
                    </li>
                  @endif
                  <li class="dropdown">
                    <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i>
                        <span>Website Content</span>
                    </a>
                    <ul class="nav-submenu menu-content">
                        <li><a href="{{ route('product') }}">Add Products</a></li>
                        <li><a href="{{ route('subjects') }}">Add Subjects</a></li>
                        <li><a href="{{ route('prakasanis') }}">Add Prokashonis</a></li>
                        <li><a href="{{ route('writers') }}">Add Writers</a></li>
                        @if (Auth::guard('admin')->user()->role == 0)
                            <li><a href="{{ route('slider') }}">Sliders</a></li>
                            <li><a href="{{ route('mini_banner') }}">Mini Banners</a></li>
                            <li><a href="{{ route('blogbackend') }}">Blogs</a></li>
                            <li><a href="{{ route('websiteInformation') }}">Website Information</a></li>
                            <li><a href="{{ route('corporateBackend') }}">Corporate Order Page</a></li>
                        @endif
                    </ul>
                  </li>
                    @if (Auth::guard('admin')->user()->role == 0 || Auth::guard('admin')->user()->role == 2)
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="javascript:void(0)">
                                <i data-feather="shield"></i>
                                <span>Administration</span>
                            </a>
                            <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('padding_product') }}">Pending Products</a></li>
                            @if (Auth::guard('admin')->user()->role == 0)
                                <li><a href="{{ route('all_product') }}">All Products</a></li>
                                <li><a href="{{ route('all_subjects') }}">All Subjects</a></li>
                                <li><a href="{{ route('all_prakasanis') }}">All Prokashonis</a></li>
                                <li><a href="{{ route('all_writers') }}">All Writers</a></li>
                                <li><a href="{{ route('controllcontent') }}">Controll Site Content</a></li>
                                <li><a href="{{ route('coupon') }}">Coupon</a></li>
                                <li><a href="{{ route('shippingFee') }}">Shipping Fee</a></li>
                            @endif
                            </ul>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->role == 0 || Auth::guard('admin')->user()->role == 2)
                    <li class="dropdown">
                        <a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="trending-up"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('sales_record') }}">Sales Record</a></li>
                        </ul>
                    </li>
                  @endif
                    @if (Auth::guard('admin')->user()->role == 0)
                        <li class="dropdown">
                            <a class="nav-link menu-title" href="javascript:void(0)">
                                <i data-feather="users"></i>
                                <span>Users</span>
                            </a>
                            <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('viewusers') }}">Admin & User</a></li>
                            <li><a href="{{ route('viewvendors') }}">Vendors</a></li>
                            <li><a href="{{ route('viewCustomers') }}">Customers</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </header>
        {{-- header-end --}}
        <div class="page-body ecommerce-dash">
            <div class="container-fluid">
                <div class="page-header dash-breadcrumb" style="padding-bottom: 70px;">
                    {{ $slot }}
                </div>
            </div>

        {{-- footer --}}
        <footer class="footer" style="position: absolute; width: 100%; left: 0; bottom: 0">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright {{ date('Y') }} © Boinama All rights reserved.</p>
              </div>
              <div class="col-md-6 text-end">
                <p class="pull-right mb-0">Design & Developed By <a href="http://www.creativesheba.com/" target="_blank" class="ms-1 text-danger">Cretive Sheba</a></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ url('backend') }}/{{ "assets/js/jquery-3.5.1.min.js" }}"></script>
    <!-- feather icon js-->
    <script src="{{ url('backend') }}/{{ "assets/js/icons/feather-icon/feather.min.js" }}"></script>
    <script src="{{ url('backend') }}/{{ "assets/js/icons/feather-icon/feather-icon.js" }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ url('backend') }}/{{ "assets/js/sidebar-menu.js" }}"></script>
    <script src="{{ url('backend') }}/{{ "assets/js/config.js" }}"> </script>
    <!-- Bootstrap js-->
    <script src="{{ url('backend') }}/{{ "assets/js/bootstrap/popper.min.js" }}"></script>
    <script src="{{ url('backend') }}/{{ "assets/js/bootstrap/bootstrap.min.js" }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ url('backend') }}/{{ "assets/js/counter/jquery.waypoints.min.js" }}"></script>
    <script src="{{ url('backend') }}/{{ "assets/js/dashboard/dashboard_2.js" }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Plugins JS Ends-->
    <script src="{{ url('backend') }}/{{ 'assets/js/script.js' }}"></script>
    @stack('script')
    <script>
        function showTime(){
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if(h == 0){
                h = 12;
            }

            if(h > 12){
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;

            setTimeout(showTime, 1000);

        }

        showTime();
    </script>
    <!-- login js-->
    <!-- Plugin used-->
    @livewireScripts
    @stack('scripts')
  </body>
</html>
