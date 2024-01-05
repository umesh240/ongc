<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @php
  $usrIdd = @Auth()->user()->id;
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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pages/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
    <style>
        .content-header { padding: 4px 0.5rem !important; }
        label { margin-bottom: 0 !important; margin-top: 6px !important; }
        /*
        @if(@$usrIdd <= 0 || @$usrIdd == '')
        .sidebar-mini.sidebar-collapse .main-footer {   margin-left: 0px !important; margin-left: 0px !important;   }
        @endif
        */
        .select2-container{ min-width:100% !important; width:100% !important; }
        input[type="text"]:not(.lc){
          text-transform: capitalize;
        }
        body{ overflow-x: hidden; }
        /** BEGIN CSS **/

        @keyframes rotate-loading {
            0%  { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        :root {
          --wd_ht: 100px;
          --logo_mr: 4%;
          --logo_wd: 92%;  
        }
        .loading-container {
            background-color: #797777b0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: fixed;
            top:0;
            left:0;
            width:100%;
            z-index: 1111;

        }

        .logo {
            position: absolute; 
            width: var(--wd_ht);
            height: var(--wd_ht);
        }

        .loading {
            width: var(--wd_ht);
            height: var(--wd_ht);
            border-radius: 50%;
            border: 2px solid transparent;
            border-color: transparent #fff transparent #fff; /* Change the color if needed */
            animation: rotate-loading 1.5s linear infinite;
            transform-origin: 50% 50%;
        }

        .logo img{    width: var(--logo_wd); margin: var(--logo_mr); }
        .tableExport thead td, .tableExport thead th, .tableExport tfoot td, .tableExport tfoot th{
          padding: 5px;
        }
        .tableExport tbody td{
          padding: 3px 5px 3px 5px;
        }
    </style>
    @yield('css')
</head>
<!--<body class="control-sidebar-slide-open sidebar-collapse layout-navbar-fixed layout-fixed sidebar-mini ">-->
<body class="sidebar-mini layout-fixed">
    <div class="loading-container">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        <div class="loading"></div>
    </div>
    <!-- Site wrapper -->
    <div class="wrapper">
        @if(@$usrIdd > 0)
        @include('_siderBar')    
        @endif
        @yield('content')

    </div>
</body>
<!-- jQuery -->
<script src="{{ asset('pages/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('pages/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('pages/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('pages/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('pages/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('pages/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('pages/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('pages/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('pages/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('pages/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
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
    var customFooter = function (currentPage, pageCount) {
      //console.log(currentPage);
      if (currentPage !== undefined && pageCount !== undefined) {
          return {
              text: currentPage.toString() + ' of ' + pageCount.toString(),
              alignment: 'center',
              fontSize: 18,
              marginBottom: 10,
              color: "black"
          };
      }
      // Handle the case where currentPage or pageCount is undefined
      return null;
  };

    $(".tablePrint").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#DataTables_Table_0_wrapper .col-md-6:eq(0)');
///////////////////////////////////////////////////////////////////////////////////////////
    // $(".tableExport").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false, "paging": false, "ordering": false, "info": false,
    //   "buttons": [{
    //   extend: 'pdfHtml5',
    //   customize: function (doc) {
    //     // Use a setTimeout to allow DataTables to fully initialize
    //     setTimeout(function () {
    //       var pageCount = doc.internal.getNumberOfPages();
    //       for (var i = 1; i <= pageCount; i++) {
    //         doc.setPage(i);
    //         doc.text(20, 20, 'Page ' + i + ' of ' + pageCount); // Change the position as needed
    //       }
    //     }, 10);
    //   },
    // }, "excel", "pdf", "print"]
    // }).buttons().container().appendTo('#DataTables_Table_0_wrapper .col-md-6:eq(0)');\

$(".tableExport").DataTable({
  "responsive": true,
  "lengthChange": false,
  "autoWidth": false,
  "searching": false,
  "paging": false,
  "ordering": false,
  "info": false,
  "buttons": [
    /*{
      extend: 'pdfHtml5',
      title: $(".tableExport").attr('data-pgNam'),
      customize: function (doc) {
        doc.pageMargins = [20, 20, 10, 20]; // [left, top, right, bottom]
      },
    },
    "print",*/
    //"excel",
    {
      extend: 'excel',
      title: $(".tableExport").attr('data-pgNam'),
      text: '<i class="fa fa-file-excel"></i> Export to Excel', // Optional custom button text
      exportOptions: {
        modifier: {
          page: 'all'
        }
      },
      filename: ($('.tableExport').attr('data-pgNam').replaceAll("\n", ",")).replaceAll(":", "-"),
      action: function (e, dt, button, config) {
        // Your custom function to be executed on Excel button click
        console.log(123);
        $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
      },
      className: 'btn-sm btn-warning'
    }
  ]
}).buttons().container().appendTo($('#export-button-container'));
 
//////////////////////////////////////////////////////////////////////////////////////////
    $('.tblResponsiv').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
  /////////////////////////////////////////////////////////////////
  function recordsDelete(thiss, idd, code=''){
    var cnf = confirm("Are you sure to delete it..?");
    if(cnf){
      if(parseInt(idd) > 0){
        var url = $(thiss).attr('data-link');
        $.ajax({
          type: "POST",
          url: url,
          data: {id:idd, code:code, _token: "{{ csrf_token() }}"},
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
///////////////////////////////////////////////////////////////////////////////////
function loadNotification(){
  var link = $('.liNotofication').attr('data-link');
  $.ajax({
    type: 'GET',
    url: link,
    success: function (response) {
      //console.log(response);
      $('.liNotofication').html(response);
    },
    error: function (xhr, status, error) {
      console.log('Error:', error);
    }
  });
  setTimeout(function(){  loadNotification();  }, 500 * 60);
}  
loadNotification();
$('[data-toggle="tooltip"]').tooltip();
//////////////////////////////////////////////////////////////////////////////
</script>
@yield('javascript')
<script>
  setTimeout(function(){
    $('.loading-container').css('display', 'none');
  }, 1000);

  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>
</html>
