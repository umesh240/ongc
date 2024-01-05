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
    <link rel="stylesheet" href="{{ asset('pages/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('pages/user_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/viewer.css') }}">
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
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- left navbar links -->
        <div class="container">
          <div class="header-logo">
            <img src="{{ asset('images/logo.png') }}">
          </div>
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <li class="userName"><span ><i class="fa fa-user" aria-hidden="true"></i></span> {{ @$user_name; }}</li>
            <li class="LogOUTbutton"><a href="{{ route('logout'); }}"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span> Log-out</a></li>
          </ul>
        </div>
      </nav>
      <!-- /.navbar -->
      @yield('content')
      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-4 col-2">
              <!-- <p>&copy; 2023 Your Website Name</p> -->
              <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}">
              </div>
            </div>
            <div class="col-md-6 col-sm-8 col-10">
               <div class="footer-list">
                 <ul class="m-0">
                  @if(!empty(trim($phone)))
                    <li><i class="fa fa-phone"></i><b>Contact No. :</b> {{ $phone }}</li>
                  @endif
                  @if(!empty(trim($email)))
                    <li><i class="fa fa-envelope"></i><b>Email Id :</b> {{ $email }}</li>
                  @endif
                 </ul>
              </div>
            </div>
          
          </div>  
        </div>
      </footer>
    </div>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('pages/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('pages/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('pages/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

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
        /*
        $(".tablePrint").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": true,
          "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#DataTables_Table_0_wrapper .col-md-6:eq(0)');
        */
      });
      /////////////////////////////////////////////////////////////////
      function recordsDelete(thiss, idd){
        var cnf = confirm("Are you sure to delete it..?");
        if(cnf){
          if(parseInt(idd) > 0){
            var url = $(thiss).attr('data-link');
            $.ajax({
              type: "POST",
              url: url,
              data: {id:idd, _token: "{{ csrf_token() }}"},
              success:function(result){
                //console.log(result);
                result = result.trim();
                result = result.split('||');
                var msg = result[1];
                var mod = result[2];
                show_msgT(mod, msg);
                if(mod == '1'){
                setTimeout(function() {
                  location.reload();
                }, 2000);
                }
              }
            });
          }else{
            show_msgT(1, 'Deleted successfully');
            $(thiss).closest('tr').remove();
          }
        }
      }  
    bsCustomFileInput.init();
      @if ($errors -> any())
        @foreach($errors -> all() as $error)
      show_msgT(3, "{{ $error }}");
      @endforeach
      @endif
      @if(session('success') && session('success') != 'S')
        show_msgT(1, "{{ session('success') }}");
      @endif
      @if (@session('message') && @session('message')['status'] >= 0 && @session('message')['status'] != "S")
        show_msgT("@php echo @session('message')['status']; @endphp", "@php echo @session('message')['message']; @endphp");
      @endif

      //////////////////////////////////////////////////////
      var lp = 0;
      $('.panel-default .panel-heading a').on('click', function(){
        var hasClass = $(this).hasClass('collapsed');
        if(lp == 0){
          lp++;
          hasClass = true;
        }
        $('.panel-default .panel-heading a').addClass('collapsed');
        $('.panel-default .panel-heading a').attr('aria-expanded', 'false');
        $('.panel-collapse').removeClass('show');
        if(hasClass === false){
          $(this).removeClass('collapsed');
          $(this).attr('aria-expanded', 'true');
          var hrefId = $(this).attr('href');
          $(hrefId).addClass('show');
        }
        //$('.panel-default .panel-heading').css('display', 'none');
      });
      //////////////////////////////////////////////////////////////////////////////////
      setTimeout(function(){
        $('.loading-container').css('display', 'none');
      }, 1000);
      
    </script>
    @yield('javascript')
  </body>
</html>
