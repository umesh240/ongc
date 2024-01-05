<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @php
  $usrIdd = @Auth()->user()->id;
  $user_name = @Auth()->user()->name;
  @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('pages/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/fontawesome6.5.1/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('pages/plugins/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/owl/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/flickity/flickity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/style.css') }}">
    
    <style>
        .content-header { padding: 4px 0.5rem !important; }
        label { margin-bottom: 0 !important; margin-top: 6px !important; }
        .select2-container{ min-width:100% !important; width:100% !important; }
        input[type="text"]{
          text-transform: capitalize;
        }
        body{ overflow-x: hidden; }
    </style>
    
  </head>
  <!--<body class="control-sidebar-slide-open sidebar-collapse layout-navbar-fixed layout-fixed sidebar-mini ">-->
  <body class="sidebar-mini layout-fixed">

  <section class="ongc-head desktop ccsticky-nav">
<div class="container">
  <nav class="navbar navbar-expand-lg ">
    <a class="navbar-brand" href="#">
      <img src="{{ asset('/pages/images/ongc-red-logo.png') }}" alt="ONGC" id="ongc-red">
      <img src="{{ asset('/pages/images/Ongc-Green-Logo1.png') }}" alt="ONGC Logo">
      <img src="{{ asset('/pages/images/logo_1.png') }}" alt="Indian Energy Logo" 
        id="logo-two">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
  <!--  <div class="collapse navbar-collapse pt-3" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('my.dashboard') }}"> <i class="fas fa-home"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('my.page', ['page'=>'flight']) }}"><i class="fas fa-fighter-jet"></i>Flight</a>
        </li>
        <li class="nav-item">
          <div class="downMenu">
            <button class="downBtn">
              <a href="#" class="nav-link"><i class="fas fa-bars"></i>Menus</a>
            </button>
            <div class="downMenu-content">
               Column 1
              <div class="menuCol">
                <a href="{{ route('my.page', ['page'=>'day_wise']) }}">Day Wise Event</a>
                <a href="#">About Local Area</a>
                <a href="{{ route('my.page', ['page'=>'quiz']) }}">Quiz</a>
                <a href="{{ route('my.page', ['page'=>'helpdesk']) }}">Help Desk</a>
              </div>

               Column 2
              <div class="menuCol">
                <a href="{{ route('my.page', ['page'=>'date_wise']) }}">Date Wise Event</a>
                <a href="{{ route('my.page', ['page'=>'about']) }}">About ONGC & IEW</a>
                <a href="{{ route('my.page', ['page'=>'faq']) }}">FAQ’s</a>
                <a href="{{ route('my.page', ['page'=>'feedback']) }}">Feedback</a>
              </div>

               Column 3
              <div class="menuCol">
                <a href="{{ route('my.page', ['page'=>'participation']) }}">Participation Status</a>
                <a href="#">Wayfinder</a>
                <a href="{{ route('my.page', ['page'=>'change_password']) }}">Change Password</a>
              </div>


              Column 4
              <div class="menuCol">
                <a href="#">Local Weather </a>
                <a href="#">Latest News</a>
                <a href="#">Social Wall</a>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-comments"></i>Chat</a>
         </li>
      </ul>
       </div>--->
        <div class="weather ml-auto">
          <div class="weather-image mr-3">
            <img src="{{ asset('/pages/weather-images/02d_2x_.png') }}" alt="Weather Icon"><span class="text-white weather-degree">35°</span>
                       <div class="nav navbar-header navbar-profile  pull-right">
      <ul class="nav">
        <li class="dropdown ">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fas fa-ellipsis-v"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="#" title="Logout">Logout </a>
            </li>
          </ul>
        </li>
      </ul>
          </div>

    </div>
        </div> 
        

  </nav>
  </div>
  </section>

  @yield('content')
 
 
 
<!--- footer nav--->
 
<div class="container">
<nav class="nav_bottom">
    <a href="{{ route('my.dashboard') }}" class="nav__link">
        <i class="material-icons nav__icon"><i class="fas fa-home"></i>
        </i>
        <span class="nav__text">Home</span>
    </a>
    <a href="{{ route('my.page', ['page'=>'flight']) }}" class="nav__link nav__link--active">
        <i class="material-icons nav__icon"><i class="fas fa-fighter-jet"></i></i>
        <span class="nav__text">Flight</span>
    </a>
    <a href="#" class="nav__link">
        <i class="material-icons nav__icon"><i class="fas fa-bars"></i></i>
        <span class="nav__text">Menu</span>
    </a>
    <a href="#" class="nav__link">
        <i class="material-icons nav__icon"><i class="fas fa-comments"></i></i>
        <span class="nav__text">Chat</span>
    </a>

</nav>
</div>
 
 
 
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery -->
  <script src="{{ asset('pages/plugins/jquery/jquery.slim.min.js') }}"></script>
  <script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('pages/plugins/popper/popper.min.js') }}"></script>
  <script src="{{ asset('pages/plugins/owl/owl.carousel.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('pages/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('pages/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('pages/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('pages/plugins/flickity/flickity.pkgd.min.js') }}"></script>

  <!-- Toastr -->
  <script src="{{ asset('pages/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('pages/others/common.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('pages/dist/js/adminlte.min.js') }}"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2();
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
    });
    
     //team//
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: ["<i class='fa fa-long-arrow-left text-orange'></i>", "<i class='fa fa-long-arrow-right text-orange'></i>"],
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 3
      }
    }
  });


  //slider js//
  var flkty = new Flickity('.carousel', {
    cellAlign: 'center',
    contain: true,
    wrapAround: true,
    autoPlay: 2000,
    prevNextButtons: true,
    pageDots: false,
    cellSelector: '.carousel-cell',
    percentPosition: false,
    initialIndex: 1, // Set the initial index to the second slide
    rightToLeft: true, // Reverse the order of cells
    friction: 0.5, // Adjust the friction for a smoother transition
  });



  //toggle//
  $(document).ready(function () {
    $('.navbar-toggler').click(function () {
      $('#navbarNav').toggleClass('show');
    });
  });
  
  

  
  
  
  </script>
  @yield('javascript')
  </body>
</html>
