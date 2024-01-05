  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown liNotofication" data-link="{{ route('get_notification') }}">
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="{{ asset('images/logo.png') }}" title="{{ asset('images/logo.png') }}" alt="Photo" class="img-size-32 mr-3 img-circle" style="border: 1px solid;">
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right m-0 p-0">
          <div class="dropdown-divider m-0"></div>
          <a href="" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> {{ __('Profile') }}
          </a>
          <div class="dropdown-divider m-0"></div>
          <a href="{{ route('logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i>  {{ __('Logout') }}
          </a>
          <div class="dropdown-divider m-0"></div>
        </div>
      </li>
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}E Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    @php 
    $curRouteNm = Route::currentRouteName();
    $parameter = '';
    if($curRouteNm == 'about.links'){
      $request = request();
      $parameter = @$request->route('about');
      $curRouteNm = $curRouteNm.'_'.$parameter;
    }
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @php echo in_array($curRouteNm, ['', 'dashboard']) ? 'active' : ''; @endphp ">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['event', 'event.ae']) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['event', 'event.ae']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p> Event <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('event') }}" class="nav-link @php echo in_array($curRouteNm, ['event']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('event.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['event.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['hotel', 'hotel.ae',]) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['hotel', 'hotel.ae']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-university"></i>
              <p> Hotel <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('hotel') }}" class="nav-link @php echo in_array($curRouteNm, ['hotel']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('hotel.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['hotel.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['employee', 'employee.ae', 'import_bookevent']) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['employee', 'employee.ae', 'import_bookevent']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-users"></i>
              <p> Employee <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employee') }}" class="nav-link @php echo in_array($curRouteNm, ['employee',]) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['employee.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('import_bookevent') }}" class="nav-link @php echo in_array($curRouteNm, ['import_bookevent']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Import</p>
                </a>
              </li>
            </ul>
          </li>
          <!--
          <li class="nav-item  @php echo in_array($curRouteNm, ['bookevent', 'bookevent.ae', 'import_bookevent']) ? 'menu-open' : ''; @endphp ">
            <a href="#" class="nav-link  @php echo in_array($curRouteNm, ['bookevent', 'bookevent.ae', 'import_bookevent']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p> Transaction <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('bookevent') }}" class="nav-link @php echo in_array($curRouteNm, ['bookevent', 'bookevent.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Book Event</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('import_bookevent') }}" class="nav-link @php echo in_array($curRouteNm, ['import_bookevent']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Event Booking</p>
                </a>
              </li>
            </ul>
          </li>
          -->
          <li class="nav-item @php echo in_array($curRouteNm, ['hotel_wise', 'hotel_wise_search', 'check_inout_summery', 'check_inout_summery_show']) ? 'menu-open' : ''; @endphp ">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['hotel_wise', 'hotel_wise_search', 'check_inout_summery', 'check_inout_summery_show']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-file-alt"></i>
              <p> Reports <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('hotel_wise') }}" class="nav-link @php echo in_array($curRouteNm, ['hotel_wise', 'hotel_wise_search']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Event-Hotel Wise</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('check_inout_summery') }}" class="nav-link  @php echo in_array($curRouteNm, ['check_inout_summery', 'check_inout_summery_show']) ? 'active' : ''; @endphp">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Check-In/Out Summary</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['quiz', 'quiz.ae', 'quiz.import']) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['quiz', 'quiz.ae', 'quiz.import']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-question-circle"></i>
              <p> Quiz <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('quiz') }}" class="nav-link @php echo in_array($curRouteNm, ['quiz']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('quiz.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['quiz.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('quiz.import') }}" class="nav-link @php echo in_array($curRouteNm, ['quiz.import']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Import</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['leaders', 'leaders.ae',]) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['leaders', 'leaders.ae']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-university"></i>
              <p> Leaders <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('leaders') }}" class="nav-link @php echo in_array($curRouteNm, ['leaders']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('leaders.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['leaders.ae']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['about.links', 'about.links_ongc', 'about.links_iew', 'about.links_event_location']) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['about.links', 'about.links_ongc', 'about.links_iew', 'about.links_event_location']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-globe"></i>
              <p> About <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('about.links', ['about' => 'ongc']) }}" class="nav-link @php echo in_array($curRouteNm, ['about.links_ongc']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>ONGC</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('about.links', ['about' => 'iew']) }}" class="nav-link @php echo in_array($curRouteNm, ['about.links_iew']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>IEW</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('about.links', ['about' => 'event_location']) }}" class="nav-link @php echo in_array($curRouteNm, ['about.links_event_location']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Event Location</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @php echo in_array($curRouteNm, ['faqs', 'faqs.ae', 'faqs.delete', 'faqs.save']) ? 'menu-open' : ''; @endphp">
            <a href="#" class="nav-link @php echo in_array($curRouteNm, ['faqs', 'faqs.ae', 'faqs.delete', 'faqs.save']) ? 'active' : ''; @endphp ">
              <i class="nav-icon fas fa-comments"></i>
              <p> FAQs <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('faqs') }}" class="nav-link @php echo in_array($curRouteNm, ['faqs']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('faqs.ae', ['ae' => 'add']) }}" class="nav-link @php echo in_array($curRouteNm, ['faqs.ae', 'faqs.delete', 'faqs.save']) ? 'active' : ''; @endphp ">
                  <i class="far fa-circle nav-icon text-success"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('feedback') }}" class="nav-link @php echo in_array($curRouteNm, ['feedback']) ? 'active' : ''; @endphp ">
              <i class="fas fa-comment-dollar nav-icon"></i>
              <p>Feedback</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('socials') }}" class="nav-link @php echo in_array($curRouteNm, ['socials']) ? 'active' : ''; @endphp ">
              <i class="fas fa-link nav-icon"></i>
              <p>Social Links</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('sos_contact') }}" class="nav-link @php echo in_array($curRouteNm, ['sos_contact']) ? 'active' : ''; @endphp ">
              <i class="fas fa-phone-square nav-icon"></i>
              <p>Contact-us / SOS</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>