@extends('layouts.app_user_new')
@php
  @$curRouteNm = Route::currentRouteName();
  @$pageNm = 'Dashboard';
  @$boardDirectors = @$hotel_imageAll = [];
  //echo '<pre>'; print_r(@$userData); die;

  @$hotel_imageAll[] = 'default.png';
  @$image_path = asset('/storage/app/hotel_image').'/';
  @$hotel_imageCnt = 1;
  @$emp_ev_book_id = @$event_pdf_file = '';
  @$cod = 0;
    
  if(@$status == 200){  
    @$boardDirectors = @$userData->boardDirectors;
    @$hotel_image = @$userData->hotel_details->hotel_image;
    @$image_path = @$userData->hotel_details->image_path;

    @$hotelImages = explode('||', @$hotel_image);
    @$hotel_imageCnt = count(@@$hotelImages);
    if(@$hotel_imageCnt > 0){
      @$hotel_imageAll = @$hotelImages;
    }

    @$event_datefr = @@$userData->event_datefr;
    @$event_datefr1 = date('d/m/Y', strtotime(@$event_datefr));
    @$event_dateto = @@$userData->event_dateto;
    @$event_dateto1 = date('d/m/Y', strtotime(@$event_dateto));
    @$event_name = @@$userData->event_name;
    @$event_mapurl = @@$userData->event_mapurl;
    @$event_details = @@$userData->event_details;


    @$hotel_name         = @@$userData->hotel_details->hotel_name;
    @$hotel_address      = @@$userData->hotel_details->hotel_address;
    @$hotel_geolocation  = @@$userData->hotel_details->hotel_geolocation;
    @$fpr_name           = @@$userData->hotel_details->fpr_name;
    @$fpr_mob_no         = @@$userData->hotel_details->fpr_mob_no;
    @$hosp_fpr_name      = @@$userData->hotel_details->hosp_fpr_name;
    @$hosp_fpr_mob_no    = @@$userData->hotel_details->hosp_fpr_mob_no;

    @$logisticFPR    = @$fpr_name.', '.@$fpr_mob_no;
    @$hospitalityFPR = @$hosp_fpr_name.', '.@$hosp_fpr_mob_no;


    @$arv_flight_name    = @@$userData->arv_flight_name;
    @$arv_flight_no      = @@$userData->arv_flight_no;
    @$arv_date_time      = @@$userData->arv_date_time;
    @$arv_date_time1     = date('d/m/Y h:i A', strtotime(@$arv_date_time));
    @$arv_location       = @@$userData->arv_location;
    @$dptr_flight_name   = @@$userData->dptr_flight_name;
    @$dptr_flight_no     = @@$userData->dptr_flight_no;
    @$dptr_date_time     = @@$userData->dptr_date_time;
    @$dptr_date_time1    = date('d/m/Y h:i A', strtotime(@$dptr_date_time));
    @$dptr_location      = @@$userData->dptr_location;

    @$arv_flightInfo = [];
    @$arv_flightInfo[] = "Flight no.: <b>".@$arv_flight_no."</b>";
    if(trim(@$arv_flight_name) != ''){
      @$arv_flightInfo[] = " (<b>".@$arv_flight_name."</b>)";
    }
    @$arv_flightInfo[] = " date of <b>".@$arv_date_time1."</b>";
    if(trim(@$arv_location) != ''){
      @$arv_flightInfo[] = " on <b>".@$arv_location."</b> airport";
    }
    @$arv_flightInfo = implode(' ', @$arv_flightInfo);


    @$dptr_flightInfo = [];
    @$dptr_flightInfo[] = "Flight no.: <b>".@$dptr_flight_no."</b>";
    if(trim(@$dptr_flight_name) != ''){
      @$dptr_flightInfo[] = " (<b>".@$dptr_flight_name."</b>)";
    }
    @$dptr_flightInfo[] = " date of <b>".@$dptr_date_time1."</b>";
    if(trim(@$dptr_location) != ''){
      @$dptr_flightInfo[] = " on <b>".@$dptr_location."</b> airport";
    }
    @$dptr_flightInfo = implode(' ', @$dptr_flightInfo);

    @$drvr_name     = @@$userData->drvr_name;
    @$drvr_number   = @@$userData->drvr_number;
    @$veh_details   = @@$userData->drvr_veh_details;

    @$assign_check_in    = @@$userData->assign_check_in;
    @$assign_check_in1   = date('d/m/Y', strtotime(@$assign_check_in));
    @$assign_check_out   = @@$userData->assign_check_out;
    @$assign_check_out1  = date('d/m/Y', strtotime(@$assign_check_out));
    @$user_check_in      = @@$userData->check_in;
    @$user_check_out     = @@$userData->check_out;
  }



@endphp
@section('title', @$pageNm)
@section('content')
<style>
.toolbar{ display:none !important;  }	
.eventPdf #viewerContainer{ inset: 0 !important;  }	
.owl-carousel .owl-item img { 
    height: 300px; 
}
</style>
 <!--Main slider-->
<section class="slider-main mt-2">
  <div class="carousel" data-flickity>
    @foreach(@$hotel_imageAll as $image)
    <div class="carousel-cell">
      <img src="{{ @$image_path.$image }}" alt="{{ @$image }}">
    </div>
    @endforeach
	</div>
</section>


  <section class="content">
    <div class="container">

      <div class="event-content">
        <div class="row pt-2 pb-2">

          <div class="col-md-10 col-10 pl-5">
           <!-- <p class="text-light event-text">Event Name<br>From: {{@$event_datefr1.' - '.@$event_dateto1}} ({{ @$event_name }})</p> -->
           
            <p class="mb-0 text-white" style="font-size: 17px;">
            <b> {{ @@$hotel_name }}</b><br>{{ @$hotel_address }}
          </p>
          </div>
          <div class="col-md-2 col-2">
            <a href="{{ @$event_mapurl }}" target="_blank"  title="Event Map Location">
              <div class="icon-event">
                <i class="fa-solid fa-location-dot"></i>
              </div>
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>


<section class="hotel-event">
 <div class="container">
   <div class="hotel-bg">
    <div class="row">
      <div class="col-md-10 col-10">
       <p class="text-light event-text">Event Name<br>From: {{@$event_datefr1.' - '.@$event_dateto1}} ({{ @$event_name }})</p>
       </div>
        <div class="col-md-2 col-2">
           <a href="{{ @$event_mapurl }}" target="_blank"  title="Event Map Location">
              <div class="icon-event text-center">
                <i class="fa-solid fa-location-dot"></i>
              </div>
          </a>
        </div>
     </div>
   </div>
</div>
</section>


  <div class="container ">
    <div class="row pt-5 ">
      <div class="col-md-8 mx-auto">
       <h3 style="color: #457CB2;">FPR Detail</h3>
        <div class="user-details p-4">
          <p class="mb-0">
            <b>FPR 1 Detail :- </b> {{ @$logisticFPR }}<br>
            <b>FPR 2 Detail :-</b> {{ @$hospitalityFPR }}
          </p>
          <!--<a href="{{ @$hotel_geolocation }}" target="_blank" title="Hotel Map Location"><i class="fa-solid fa-location-dot"></i></a>-->
        </div>
      </div>
      <div class="col-md-10 ml-auto col-xl-12 mr-auto">
        <!-- Nav tabs -->
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs desktop-tabs " role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#checkInOut" role="tab">Check-in/out</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#flightDetails" role="tab"> Flight Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#travelSchedule" role="tab">Transportation Arrangements</a>
              </li>
            </ul>
          </div>
          <div class="card-body p-4">
            <!-- Tab panes -->
            <div class="tab-content text-center"> 
              <div class="tab-pane active" id="checkInOut" role="tabpanel">
                <div >
                  <div class="row ">
                    <div class="col-md-6 col border-right">
                      <div class="check-time check-tab">
                        <h4>Check-in</h4>
                        <p class="mb-0">{{ @$assign_check_in1 }}</p>
                        <p class="text-success">{{ @$assign_check_in1 }}</p>
                      </div>
                    </div>
                    <div class="col-md-6 col">
                      <div class="check-time check-tab">
                        <h4>Check-out</h4>
                        <p class="mb-0">{{ @$assign_check_out1 }}</p>
                        <p class="text-success">{{ @$assign_check_out1 }}</p>
                      </div>
                    </div>
                    <div class="col-md-12 pt-3">
                      <div class="tab-btn">
                        <button class="btnCkInOut" type="submit">Confirm Check-in</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="flightDetails" role="tabpanel">
                <div class="row">
                  <div class="col-sm-12 pr-1 pl-1" style="border: 1px solid #ccc; border-radius: 10px;">
                    <h5 class="mb-0">Arraival</h5>
                    <p class="text-left mb-0">@php echo @$arv_flightInfo; @endphp</p>
                  </div>
                  <div class="col-sm-12 pr-1 pl-1 mt-1" style="border: 1px solid #ccc; border-radius: 10px;">
                    <h5 class="mb-0">Departure</h5>
                    <p class="text-left mb-0">@php echo @$dptr_flightInfo; @endphp</p>
                  </div>
                </div>
              </div>
              <div class="tab-pane text-left" id="travelSchedule" role="tabpanel">
                <p class="mb-0"><b>Driver : </b>{{ @$drvr_name.' '.@$drvr_number }}</p>
                <p class=""><b>Vehicle : </b>{{ @$veh_details }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!------minsters----->
  <div class="container-fluid">
    <div class="row">
      <div class="carousel-wrap">
        <h3 class="pb-4">ONGC's Board of Directors</h3>
        <div class="owl-carousel pt-3">
          @foreach(@$boardDirectors as $leader)
          <div class="item">
            <img src="{{ @$leader->l_photo }}">
            <div class="ministers-head">
              <h5 class="text-center pt-2">{{ @$leader->l_name }}<br>{{ @$leader->l_post }}</h5>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>




  <!-- about-local -->
  <section class="locals">
    <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-12 pb-4">
          <div class="local-head">
            <h3>About Local</h3>
          </div>
        </div>

        <div class="col-3 col col-lg-3 text-center">
          <div class="local-menus">
            <div class="icon-about">
             <a href="https://www.indiaenergyweek.com/event/2fe24000-628c-4f45-a85e-4e8ed44d433c/summary" target="_blank"><i class="fas fa-bolt"></i></a>
            </div>
            <div class="local-content">
              <p>About IEW</p>
            </div>
          </div>
        </div>

        <div class="col-3 col col-lg-3 text-center">
          <div class="local-menus">
            <div class="icon-local">
             <a href="{{ route('my.page', ['page'=>'local_area']) }}"> <i class="fa-solid fa-location-dot"></i></a>
            </div>
            <div class="local-content">
              <p>About Local Area</p>
            </div>
          </div>
        </div>
        
        <div class="col-3 col col-lg-3 text-center">
          <div class="local-menus">
            <div class="icon-news">
             <a href="{{ route('my.page', ['page'=>'news']) }}"> <i class="fa-solid fa-video"></i></a>
            </div>
            <div class="local-content">
              <p>Latest News</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!----social wall---->
  <section class="wall">
    <div class="container">
      <div class="row pt-5 pb-5">
        <div class="col-md-12 pb-3">
          <div class="wall-head">
            <h3>Social Wall</h3>
          </div>
        </div>
        <div class="wall-content">
         
        </div>
      </div>
    </div>
  </section>



<!----airport destails

<section class="details">
 <div class="container">
   <h3>Airport Details</h3>
    <div class="airport-details" >
      <div class="row ">
      <div class="col-md-6 col-6">
        <img src="{{ asset('/pages/images/airport1.jpg') }}">
        <h5 class="airport-text">Dabolim Airport, Goa</h5>
      </div>
      <div class="col-md-6 col-6">
        <img src="{{ asset('/pages/images/airport2.jpg') }}">
        <h5 class="airport-text">Manohar International Airport, Mopa, Goa</h5>
      </div>
    </div>
  </div>
 </div>
 </section>--->
@endsection
