@extends('layouts.app_user')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Dashboard';
  $hotel_imageAll = [];
  //$status = @$userData->status;
  $hotel_imageAll[] = 'default.png';
  $image_path = asset('/storage/app/hotel_image').'/';
  $hotel_imageCnt = 1;
  $emp_ev_book_id = $event_pdf_file = '';
 	// echo '<pre>'; print_r($userData); die;
	$fpr_name = @$userData->hotel_details->fpr_name;
	$fpr_number = @$userData->hotel_details->fpr_mob_no;
	$cod = 0;
if($status == 200){
	$hotel_imageAll = [];
		
	$hotel_images = @$userData->hotel_details->hotel_image;

	$image_path = @$userData->hotel_details->image_path;
	if(!empty(trim($hotel_images))){
		$hotel_imageAll = explode('||', $hotel_images);
	}else{
		$hotel_imageAll[] = 'default.png';
	}
	$hotel_imageCnt = count(@$hotel_imageAll);
	$event_pdf = @$userData->event_details;
	$pdf_path = @$userData->pdf_path;
	if(!empty($pdf_path)){
		$event_pdf_file = $pdf_path.$event_pdf;
	}
	
	$emp_ev_book_id = @$userData->emp_ev_book_id;
	$event_datefr = @$userData->event_datefr;
	$event_datefr1 = date('dS M Y', strtotime($event_datefr));
	
	$event_dateto = @$userData->event_dateto;
	$event_dateto1 = date('dS M Y', strtotime($event_dateto));
	$event_dateto10 = date('d-m-Y h:i A', strtotime($event_dateto));
	$event_name = @$userData->event_name;
	$event_dt = $event_datefr1.' - '.$event_dateto1.' ('.$event_name.')';
    
	$user_details = Auth()->user();
	$name = $user_details->name;
	$location = $user_details->location;
	$designation = $user_details->designation;
	$mobile = $user_details->mobile;
	$cpf = $user_details->cpf_no;
	$email = $user_details->email;
	$level = $user_details->level;
	$category = $user_details->category;
	$emp_ev_book_id =  @$userData->emp_ev_book_id;
	$check_in = @$userData->check_in;
	$check_out =  @$userData->check_out;
	$geo_location = @$userData->hotel_details->hotel_geolocation;
	$current_date = date('Y-m-d H:i:s');
	//$event_datefr = @$userData->event_datefr;
	//$event_dateto = @$userData->event_dateto;
	$assign_check_in = @$userData->assign_check_in;
	$assign_check_out = @$userData->assign_check_out;
	$assign_check_in1 = strtotime(date('Y-m-d H:i:s', strtotime($assign_check_in)));
	
	$hotel_check_in = date('d-m-Y h:i A', strtotime($assign_check_in));
	$hotel_check_out = date('d-m-Y h:i A', strtotime($assign_check_out));
	if($assign_check_in == null){
	    $hotel_check_in = date('d-m-Y h:i A', strtotime($event_datefr));
	}
	if($assign_check_out == null){
	    $hotel_check_out = date('d-m-Y h:i A', strtotime($event_dateto));
	}
	
	$ev_datefr = strtotime(date('Y-m-d', strtotime($event_datefr)));
	$ev_dateto = strtotime($event_dateto);
    
	$current_date1 = strtotime($current_date);
	$check_in1 = strtotime($check_in);
	$check_in_fr = date('d-m-Y h i A', $assign_check_in1);
	$check_out1 = strtotime($check_out);
	$check_in_fr = $check_out_fr = '';
	if(!empty($check_out)){
      	$check_out_fr = date('d-m-Y h:i A', $check_out1);
      }
      if(!empty($check_in)){
      	$check_in_fr = date('d-m-Y h:i A', $check_in1);
      }
	
	$dis_ci = $dis_co = "disabled";
	$show_btn_co = 0;
	
	if($check_in == null){
		if($current_date1 >= $assign_check_in1){
			$dis_ci = "";
		}
		$show_btn_co = 2;
	}
	/*
	echo $current_date.'>>>'.$current_date1;
	echo "<br>";
	echo $assign_check_in.'>>>'.$assign_check_in1;
	die;
	*/
	if($check_in1 > 0 && $check_in !== null && $check_out == null){
		$dis_co = ""; //enabled
		$show_btn_co = 1;
	}


	$weather_result= @$userData->weather_result;
	//echo "<pre>"; print_r($weather_result);
	$temperature = $weather_result->main->temp;
	$temp = ($temperature - 273.15).'°c';
	$description= $weather_result->weather[0]->description;
	$wind= $weather_result->wind->speed;
	$city= $weather_result->name;
	$dt = $weather_result->dt;
	$dte = date("d M",$dt);
	$icon = $weather_result->weather[0]->icon;
	$main = $weather_result->weather[0]->main;
	$cod = $weather_result->cod;
}


@endphp
@section('title', $pageNm)
@section('content')
<style>
.toolbar{ display:none !important;  }	
.eventPdf #viewerContainer{ inset: 0 !important;  }	

</style>
<!-- Content Wrapper. Contains page content -->
<button type="button" class="sos_emrgncy checkinbtn" data-toggle="modal" data-target="#myModal"><span class="text">SOS / Emergency</span></button>

@if($status == 200 && $cod == 200)
<button type="button" class="btn_weather checkinbtn"><span class="text we_city">{{ $city.' '.$temp }}</span></button>
<div class="div_weather">
	<div class="card mb-0">
		<div class="card-header">
			<h3 style="font-size: 24px" class="card-title text-white">Today's weather</h3>
			<div class="card-tools">
				<button type="button" class="btn btn-tool we_remove" title="Remove">
					<i class="fas fa-times text-white"></i>
				</button>
			</div>
		</div>
		<div class="card-body p-0">
			<article class="widget">
				<div class="weatherIcon">
					<img src="http://openweathermap.org/img/wn/{{ $icon }}@4x.png" />
				</div>
				<div class="weatherInfo">
					<div class="temperature">
						<span>{{$temp}}</span>
					</div>
					<div class="description mr45">
						<div class="weatherCondition">{{ $main }}</div>
						<div class="place">{{ $city }}</div>
					</div>
					<div class="description">
						<div class="weatherCondition">Wind</div>
						<div class="place">{{ $wind }} M/H</div>
					</div>
				</div>
				<div class="date">
					{{ $dte }}
				</div>
			</article>
		</div>
	</div>
</div>       
@endif
<div class="loading-container">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
		
    </div>
    <div class="loading"></div>
</div>

<div class="content-wrapper">
  <!--Main slider-->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
		@foreach($hotel_imageAll as $key => $image)
        <div class="carousel-item {{ $key == 0 ?'active':'' }}">
          <img class="d-block w-100" src="{{ $image_path.$image }}" >
        </div>
		@endforeach
      </div>
	  @if($hotel_imageCnt > 1 && $hotel_imageCnt != '')
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="fas fa fa-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="fas fa fa-chevron-right" aria-hidden="true"></span>
      </a>
	  @endif
  </div>
  <!-- Main content -->
  @if($status == 200)
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <div class="event">
          <div class="left-date">
            <h4>Event</h4>
          </div>
          <div class="right-date"><h4>{{ $event_dt }}</h4></div>
        </div>
      </div>
    </div>
  </section>

 
  <section class="details">
   <div class="shapes"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="hotelDetails">
            <div class="hotelName">
              <i class="fa fa-street-view" aria-hidden="true"></i>
              <h3>
				@if(!empty($geo_location))
				<a href="{{ $geo_location }}" target="_blank">
				{{ $userData->hotel_details->hotel_name }} <font style="font-size: 14px;">({{ $userData->category_details->hotel_category }}) </font><i class="fa fa-map-marker-alt" aria-hidden="true"></i>
				</a>
				@else
				{{ $userData->hotel_details->hotel_name }} <font style="font-size: 14px;">({{ $userData->category_details->hotel_category }})</font>
				@endif
			</h3>
            </div>
            <p class="standard mb-0">{{ $userData->hotel_details->hotel_address; }}</p>
            @if(!empty($fpr_name))
						<p class="standard">
							<span style="color: var(--hotel_hcolor);">FPR details :</span> {{ $fpr_name  . ', ' . $fpr_number }}
						</p>
						@endif
          </div>
        </div>
        <!-- end -->
        <div class="col-md-6">
        
			<div id="checkinOutdates" data-route="{{ route('check_in_out') }}" data-emp-ev-book-id="{{ $emp_ev_book_id }}" data-csrf-token="{{ csrf_token() }}">
            <div class="content-box">
              <div class="middle-content">
                <h3>Check-in</h3>
				<p class="mb-0">{{ $hotel_check_in }} </p>
                <p class="text-success">{{ $check_in_fr }}</p>
              </div>
              <div class="editButton">
                <i class="fa-regular fa-pen-to-square"></i>
              </div>

              <div class="right-content">
                <h3>Check-out</h3>
				<p class="mb-0">{{ $hotel_check_out }}</p>
                <p class="text-success">{{ $check_out_fr }}</p>
              </div>
            </div>

			@if($show_btn_co == 2)
				<button type="button" class="checkinbtn cnfCkInOut" value="in" {{ $dis_ci }}>Confirm Check-in</button>
			@elseif($show_btn_co == 1)
				<button type="button" class="checkinbtn cnfCkInOut" value="out" {{ $dis_co }}>Confirm Check-out</button>
			@else
      @endif
          </div>
        </div> 
		@php  
		$flt_info = '';
		$drvr_name = @$userData->drvr_name;
		$drvr_number = @$userData->drvr_number;
		$flt_info .= $drvr_veh_details = @$userData->drvr_veh_details;

		$departureDetails = [];
		$dptr_flight_no = @$userData->dptr_flight_no;
		if(!empty(trim($dptr_flight_no))){
			$departureDetails[] = $dptr_flight_no;
		}
		$dptr_flight_name = @$userData->dptr_flight_name;
		if(!empty(trim($dptr_flight_name))){
			$departureDetails[] = $dptr_flight_name;
		}
		$dptr_date_time = @$userData->dptr_date_time;
		if(!empty(trim($dptr_date_time)) && $dptr_date_time != '0000-00-00 00:00:00'){
			$dptr_date_time1 = date('d/m/Y h:i A', strtotime($dptr_date_time));
			$departureDetails[] = $dptr_date_time1;
		}
		$dptr_location = @$userData->dptr_location;
		if(!empty(trim($dptr_location))){
			$departureDetails[] = $dptr_location;
		}
		$flt_info .= $departureDetails = implode(', ', $departureDetails);

		$arrivalDetails = [];
		$arv_flight_no = @$userData->arv_flight_no;
		if(!empty(trim($arv_flight_no))){
			$arrivalDetails[] = $arv_flight_no;
		}
		$arv_flight_name = @$userData->arv_flight_name;
		if(!empty(trim($arv_flight_name))){
			$arrivalDetails[] = $arv_flight_name;
		}
		$arv_date_time = @$userData->arv_date_time;
		if(!empty(trim($arv_date_time)) && $arv_date_time != '0000-00-00 00:00:00'){
			$arv_date_time1 = date('d/m/Y h:i A', strtotime($arv_date_time));
			$arrivalDetails[] = $arv_date_time1;
		}
		$arv_location = @$userData->arv_location;
		if(!empty(trim($arv_location))){
			$arrivalDetails[] = $arv_location;
		}
		$flt_info .= $arrivalDetails = implode(', ', $arrivalDetails);
		@endphp  
		@if(!empty(trim($flt_info)))
        <div class="vehicleDetails col-md-12">  
          <div class="row">
            <div class="col-md-6">        
              <h3>Flight Details</h3>
              <div class="">
              	@if(!empty(trim($arrivalDetails)))
                <p class="m-0"><b>Arrival : </b>{{ $arrivalDetails }}</p>
                @endif
                @if(!empty(trim($departureDetails)))
                <p class="m-0"><b>Departure : </b>{{ $departureDetails }}</p>
                @endif
              </div>
            </div>
            @if(!empty($drvr_veh_details))
            <div class="col-md-3">        
              <h3>Vehicle Details</h3>
              <div class="details">
                <p class="vehicle">{{ $drvr_veh_details }}</p>
              </div>
            </div>
            <div class="col-md-3">
              <h3>Driver Details</h3>
              <div class="details">
                <p class="vehicle">{{ $drvr_name.' '.$drvr_number }}</p>
              </div>
            </div>
            @endif
          </div>
        </div>
		@endif
      </div>
    </div>
  </section>
  @endif
  

	@php 
	$sos_info = $phone = $email = '';
	$status_sos = @$sos_contact->status;
	if($status_sos === 200){
		$sos_info = @$sos_contact->response->sos_info;
		$phone = @$sos_contact->response->phone_no;
		$email = @$sos_contact->response->email_id;
	}
	@endphp
<!-- accordian start -->
<div class="container">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		@if($status == 200)
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
						<i class="fa fa-user" aria-hidden="true"></i>day wise event
					</a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body p-0">
					@if(!empty(@$event_pdf_file))
					<iframe src="{{ @$event_pdf_file }}#toolbar=0&navpanes=0&scrollbar=0" class="eventPdf" frameborder="0" style="width: 100%; height: 600px;" ></iframe >
					@endif
				</div>
			</div>
		</div>

		<!-- <div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingTwo">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <i class="fa fa-home" aria-hidden="true"></i>hotel
					</a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
				<div class="panel-body p-0">
					<div class="form pt-4" id="hotelName">
						<div class="formheading">
							<h3 class="mt-0">Request For Hotel Change</h3>
						</div>
						@if(@$changHtlInfo->req_chng_status == 1)
						{{-- <div class="col-sm-12">
							<h4><b>Previous Request</b></h4>
							<p class="m-0">
								<b>Hotel : </b> {{ @$changHtlInfo->hotel_name.' ('.@$changHtlInfo->hotel_category.')' }}.
								<b>Instraction : </b> {{ @$changHtlInfo->req_chng_instraction }}
							</p>
							<hr style="margin: 4px; border: 1px solid #eac6c6;">
						</div> --}}
						@endif
						<form action="{{ route('change_hotel_req') }}" method="post" class="frmHotel">
							@csrf
							<input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
						<div class="form-group col-md-6 col-sm-6 col-12">
							<label for="cars">Hotel Name</label><br>
							<select class="form-control hotel_cd" name="hotel_cd" required onchange="ud.getRoomTypeList(this);" data-link="{{ route('getroomtype') }}">
								<option value="">Select hotel</option>
								@if(!empty($hotel_list))
									@foreach($hotel_list as $keyy => $hotel)
										<option value="{{ $hotel->htl_id }}">{{ $hotel->hotel_name }}</option>
									@endforeach
								@endif
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="cars">Room Type</label><br>
							<select class="form-control room_type_cd" name="room_type_cd" required></select>
						</div>
						
						<div class="form-group col-md-6">
							<label>Check-in</label>
							<div class="input-group date" id="reservationdate" data-target-input="nearest">
								<input type="date" class="form-control datetimepicker-input" data-target="#reservationdate" required>
								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"></div>
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Check-out</label>
							<div class="input-group date" id="reservationdate" data-target-input="nearest">
								<input type="date" class="form-control datetimepicker-input"data-target="#reservationdate" required>
								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"></div>
							</div>
						</div>
						

						<div class="form-group col-md-12" id="formInstructions">
              <label>Instruction</label>
              <textarea class="form-control instructions" name="instructions" rows="3" placeholder=" Any Instructions"></textarea>
						</div>
						<button class="checkinbtn btnHtlChangRequest" id="submitRequest">Submit Request</button>
            </form>
					</div>
				</div> 
			</div>
		</div> -->

		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      <i class="fa fa-fighter-jet" aria-hidden="true"></i>flight
					</a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
				<div class="panel-body p-0">
					<!-- flight form start -->
					<div class="form">
						<div class="arrival_departure">
								<div class="arrival col-md-6">
									<form class="frmFlightBook" action="{{ route('flight_book_update')}}" method="post">
										@csrf
										<input type="hidden" name="flight_book_type" class="flight_book_type" value="arr">
										<input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
										<h3>Arrival</h3>
										<div class="form-group">
											<label>Flight Name</label>
											<input type="text" class="form-control flight_name" name="flight_name" placeholder="Enter name">
										</div>
										<div class="form-group">
											<label>Flight number</label>
											<input type="text" class="form-control flight_number" name="flight_number" required placeholder="Enter number">
										</div>

										<div class="form-group">
											<label>Date & Time</label>
											<input type="datetime-local" class="form-control date_time" name="date_time" required>
										</div>

										<div class="form-group">
											<label>Location</label>
											<input type="text" class="form-control location" name="location" placeholder="Enter Location">
										</div>

										<div id="button">
											<button type="button" class="checkinbtn" onclick="ud.saveflight(this)" name="submit">Submit</button>
										</div>
									</form>
								</div>
								<div class="departure col-md-6">
									<form class="frmFlightBook" action="{{ route('flight_book_update')}}" method="post">
										@csrf
										<input type="hidden" name="flight_book_type" class="flight_book_type" value="dpt">
										<input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
										<h3>Departure</h3>
										<div class="form-group">
											<label>Flight Name</label>
											<input type="text" class="form-control flight_name" name="flight_name" placeholder="Enter name">
										</div>
										<div class="form-group">
											<label>Flight number</label>
											<input type="text" class="form-control flight_number" name="flight_number" required placeholder="Enter number">
										</div>

										<div class="form-group">
											<label>Date & Time</label>
											<input type="datetime-local" class="form-control date_time" name="date_time" required>
										</div>

										<div class="form-group">
											<label>Location</label>
											<input type="text" class="form-control location" name="location" placeholder="Enter Location">
										</div>
										<div id="button">
											<button type="button" class="checkinbtn" onclick="ud.saveflight(this)" name="submit">Submit</button>
										</div>
									</form>
								</div>
						</div>
					</div>
                  <!-- flight form end -->
				</div>
			</div>
		</div>
		<!-- <div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingThree">
				<h4 class="panel-title">
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                      <i class="fa fa-user" aria-hidden="true"></i>profile
					</a>
				</h4>
			</div>
			<div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
				<div class="panel-body p-0">
					<div class="form divProfile" id="hotelName">

						<div class="form-group col-md-6">
							<label for="exampleInputCRF">CPF Number</label>
							<span>{{ @$cpf }}</span>
						</div>

						<div class="form-group col-md-6">
							<label for="exampleInputName">Name</label>
							<span>{{ @$name }}</span>
						</div>
						<div class="form-group col-md-6">
							<label for="exampleInputnumber">Mobile Number</label>
							<span>{{ @$mobile }}</span>
						</div>

						<div class="form-group col-md-6">
							<label for="exampleInputEmail1">Email Address</label>
							<span>{{ @$email }}</span>
						</div>
						<div class="form-group col-md-6">
							<label for="exampleInputdesignation">Designation</label>
							<span>{{ @$designation }}</span>
						</div>
						<div class="form-group col-md-6">
							<label for="exampleInputcategory">Level and Category</label>
							<span>{{ @$level .' and '. @$category }}</span>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputlocation">Location</label>
							<span>{{ @$location }}</span>
						</div>
						<div class="form-group">&nbsp;</div>
							
						{{-- <button class="checkinbtn" id="submitRequest">Submit Request</button> --}}
					</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                      <i class="fa fa-phone" aria-hidden="true"></i>sos / contact-us
					</a>
				</h4>
			</div>
			<div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 text-justify">
							<p>{{ $sos_info }}</p><br><br>
						</div>
						
						<div class="col-sm-6">
							@if(!empty(trim($phone)))
								<p><b>Contact No. : </b> {{ $phone }}</p>
							@endif
						</div>
						<div class="col-sm-6">
							@if(!empty(trim($email)))
								<p><b>Email-id : </b>{{ $email }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne">
				<h4 class="panel-title">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive"><i class="fa fa-calendar-times" aria-hidden="true"></i>Participation Withdrawn/ Cancellation 
					</a>
				</h4>
			</div>
			<div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
				<div class="panel-body">
					<form class="frm_event_cancel" action="{{ route('event_cancel') }}" method="post">
						@csrf						
						<input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
						<div class="form-group col-md-12">
							<label>Select Reason</label>
							<select class="form-control reason_type" name="reason_type">
								<option value="PW">Participation Withdrawn/ Cancellation</option>
								<option value="PP">Postpone Coming Plan</option>
								<option value="DF">Delay/Change Flight</option>
								<option value="OT">Others</option>
							</select>
						</div>
						<div class="form-group col-md-12">
							<label>Write Your Reason (if any)</label>
							<textarea class="form-control cancel_reason" name="cancel_reason"  placeholder=" Enter Cancellation Reason"></textarea>
						</div>
						<button type="button" class="checkinbtn" id="submitRequest" name="button" onclick="ud.cancelReason(this)">Submit </button>
					</form>
				</div>
			</div>
		</div>
		@else
			<div class="">
				<div class="p-0">
					<h3 class="text-danger text-bold text-center mb-4">No event available at this time.</h3>
				</div>
			</div>
		@endif

	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix"
          aria-expanded="false" aria-controls="collapsesix">
          <i class="fa fa-unlock-alt" aria-hidden="true"></i>Change Password
        </a>
      </h4>
    </div>
    <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
      <div class="panel-body p-0">
        <div class="form" id="hotelName">

					<form class="form-password" action="{{ route('change_password') }}" method="post">
						@csrf
						
						<div class="form-group col-md-4">
							<label for="exampleInputCRF">Old Password</label>
							<input type="password" class="form-control" name="old_password" value=""  placeholder="your old password">
						</div>

						<div class="form-group col-md-4">
							<label for="exampleInputName">New Password</label>
							<input type="password" class="form-control" name="new_password" value="" placeholder="your new password">
						</div>

						<div class="form-group col-md-4">
							<label for="exampleInputnumber">Confirm Password</label>
							<input type="password" class="form-control" name="confirm_password" value="" placeholder="confirm password">
						</div>
						<button type="button" class="checkinbtn" id="submitRequest" name="button" onclick="ud.password(this)">Submit </button>

					</form>
        </div>
      </div>
    </div>
  </div>
		  
	</div>
</div>

 <!-- Modal -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-info text-left">
				<h4 class="modal-title">SOS/ Emergency</h4>
				<button type="button" class="close pt-1 pb-0" data-dismiss="modal" aria-label="Close">
				<i class="text-white fa fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 text-justify">
						<p>{{ $sos_info }}</p>
					</div>
					
					<div class="col-sm-6">
						@if(!empty(trim($phone)))
							<p><b>Email-id : </b> {{ $email }}</p>
						@endif
					</div>
					<div class="col-sm-6">
						@if(!empty(trim($email)))
							<p><b>Contact No. : </b>{{ $phone }}</p>
						@endif
					</div>
				</div>
				<div class="row">
					@if(!empty($fpr_name))
					<h4 class="mb-0 w-100 p-2 pl-4 bg-info"><b>FPR Details</b></h4>
					<div class="col-sm-6">
							<p><b> Name : </b>{{ $fpr_name }}</p>
					</div>
					<div class="col-sm-6">
						@if(!empty($fpr_number))
							<p><b> Contact No. : </b>{{ $fpr_number }}</p>
						@endif
					</div>
					@endif
				</div>
			</div>
					<h4 class="mb-0 w-100 p-2 pl-4 bg-info"><b>Query</b></h4>
			<div class="modal-footer text-left pt-0">
				<form class="sos-query w-100" action="{{ route('user_query') }}" method="post">
					@csrf
					<input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
					<div class="row w-100">
						<div class="col-md-12 mt-2">
							<textarea rows="2" class="form-control query_text" name="query" placeholder=" Enter your query here"></textarea>
						</div>
						<div class="col-md-12 mt-2">
							<button type="button" name="submit_query" class="checkinbtn" onclick="ud.query(this)"><i class="fa fa-save"> Submit</i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- accordian end -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('javascript')
<script>
  var wdE = $('.event').width();
  var wdW = $(window).width();
  var ml = parseInt((parseInt(wdW) - parseInt(wdE) - 34) / 2);
  $('.event').attr('style', 'left:'+ml+'px !important');
  console.log(wdW+'-'+wdE+'='+ml);
  //////////////////////////////////////////////////////////////
  
	//.eventPdf #viewerContainer{ inset: 0 !important;  }	
  //$('.eventPdf').find('.toolbar').css('display', 'none !important');

</script>
<script src="{{ asset('pages/userdashboard.js') }}"></script>
@endsection
