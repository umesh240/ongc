@extends('layouts.app')
@php
  //echo '<pre>'; print_r($event); die;
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Employee Master ';
  $pgArr = array('add' => 'Add', 'edit' => 'Update', 'hotel' => '', 'driver' => '', 'event' => '');
  if(@$page_type == 'hotel'){
    $pageNm = 'Hotel Request Change';
  }else if(@$page_type == 'driver'){
    $pageNm = 'Flight Request';
  }else if(@$page_type == 'event'){
    $pageNm = 'Event Add';
    if(@$employee->id > 0){
      $pageNm = 'Event Edit';
      if(@$event_id <= 0){
        $pageNm = "Add User's Event";
      }
    }
  }
  $intcd = $emp_ShareRmAll = $room_categorycd = $hotel_cd = $eventcd = $emp_hotel_cat_cd = $emp_hotel_cd = $emp_event_cd = '';
@endphp
@section('title', $pageNm)
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">{{ $pageNm }}<font class="activePg">{{ $pgArr[@$page_type] }}</font></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <button onclick="window.location='{{ route("employee") }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-list"></i> List</button>
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr class="w-100 mt-0">
  <!-- /.content-header -->
  @php
    $btn_name = "Save";
    $emp_ShareRmAll = '';
    $assign_check_out = $assign_check_in = $emp_ShareRm = $arv_flight_name = $arv_flight_number = $arv_date_time = $arv_flight_location = $dpt_flight_name = $dpt_flight_number = $dpt_date_time = $dpt_flight_location = $drvr_name = $drvr_number = $vehicle_details = '';

    if(@$employee->id > 0){
      $btn_name = "Update";
      $emp_event_cd = @$event->emp_event_cd;
      $hotel_cd = @$event->emp_hotel_cd;
      $room_categorycd = @$event->emp_hotel_cat_cd;
      $emp_ShareRmAll = @$event->share_room_with_empcd;
      $intcd = @$event->emp_ev_book_id;
      if(!is_null($emp_ShareRmAll)){
        $emp_ShareRmAll = explode(',', $emp_ShareRmAll);
        $emp_ShareRm = trim($emp_ShareRmAll[0]);
      }
      $arv_flight_name = @$event->arv_flight_name;
      $arv_flight_number = @$event->arv_flight_no;
      $arv_date_time = @$event->arv_date_time;
      $arv_flight_location = @$event->arv_location;
      $dpt_flight_name = @$event->dptr_flight_name;
      $dpt_flight_number = @$event->dptr_flight_no;
      $dpt_date_time = @$event->dptr_date_time;
      $dpt_flight_location = @$event->dptr_location;
      $drvr_name = @$event->drvr_name;
      $drvr_number = @$event->drvr_number;
      $vehicle_details = @$event->drvr_veh_details;
      $assign_check_out = @$event->assign_check_out;
      $assign_check_in = @$event->assign_check_in;
    }
    ////////////////////////////////////////////////////
    switch(@$page_type){
      case 'hotel':
      case 'driver':
        $submit_page = 'hotel.assign';
      break;
      default:
        $submit_page = 'employee.save';
      break;
    }
  @endphp
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ $pageNm }}</h3>
      </div>
      <form action="{{ route($submit_page) }}" method="post">
        @csrf
        <input type="hidden" name="cd" value="{{ @$employee->id }}" class="cd">
        <input type="hidden" name="page_type" value="{{ @$page_type }}" class="page_type">
        <input type="hidden" name="emp_evv_id" value="{{ @$event->emp_ev_book_id }}" class="emp_evv_id">
        <div class="card-body">
          <div class="row userInfo">
            <div class="col-sm-6">
              <label>CPF Number:</label>
              <input type="text" class="form-control form-control-sm cpf_no" name="cpf_no" value="{{ old('cpf_no')?old('cpf_no'):@$employee->cpf_no }}" placeholder=" Enter CPF Number">
            </div>
            <div class="col-sm-6">
              <label>Name:</label>
              <input type="text" class="form-control form-control-sm name" name="name" value="{{ old('name')?old('name'):@$employee->name }}" placeholder=" Enter Employee Name">
            </div>
            <div class="col-sm-6">
              <label>Email:</label>
              <input type="email" class="form-control form-control-sm email" name="email" value="{{ old('email')?old('email'):@$employee->email }}" placeholder=" Enter  E-Mail id">
            </div>
            <div class="col-sm-6">
              <label>Mobile:</label>
              <input type="text " class="form-control form-control-sm mobile int" name="mobile" value="{{ old('mobile')?old('mobile'):@$employee->mobile }}" placeholder=" Enter Mobile Number" maxlength="10">
            </div>
            <div class="col-sm-6">
              <label>Level:</label>
              <input type="text" class="form-control form-control-sm level" name="level" value="{{ old('level')?old('level'):@$employee->level }}" placeholder=" Enter Level">
            </div>
            <div class="col-sm-6">
              <label>Designation:</label>
              <input type="text" class="form-control form-control-sm designation" name="designation" value="{{ old('designation')?old('designation'):@$employee->designation }}" placeholder=" Enter Designation">
            </div>
            <div class="col-sm-6">
              <label>Category:</label>
              <input type="text" class="form-control form-control-sm category" name="category" value="{{ old('category')?old('category'):@$employee->category }}" placeholder=" Enter Category" r="">
            </div>
            <div class="col-sm-6">
              <label>Location:</label>
              <input type="text" class="form-control form-control-sm location" name="location" value="{{ old('location')?old('location'):@$employee->location }}" placeholder=" Enter Location">
            </div>
          </div>
        </div>
        @if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event')
        <h4 class="bg-primary pl-3 mb-0">Event Details</h4>
        <div class="card-body pt-0">
          <div class="row userInfo">
            <div class="col-sm-6">
              <input type="hidden" class="intcd" name="intcd" value="{{ @$intcd }}">
              <label for="exampleInputEmail1">Event Name : </label>
              <select class="form-control form-control-sm eventcd" name="eventcd"  onchange="be.getHotels(this);" data-link="{{ route('gethotel') }}" required>
                @if(!empty($event_list))
                  @if(count($event_list) > 1)
                    <option value="">Select event</option>
                  @endif
                  @foreach($event_list as $eventData)
                    <option value="{{ $eventData->ev_id }}" {{ $emp_event_cd == $eventData->ev_id?'selected':''  }} data-stt="{{ $eventData->event_datefr }}"  data-end="{{ $eventData->event_dateto }}">
                    {{ $eventData->event_name.' ('.date('d/m/Y', strtotime($eventData->event_datefr)).' - '.date('d/m/Y', strtotime($eventData->event_dateto)).')' }}
                    </option>
                  @endforeach
                @endif
              </select>
              <script> $('.eventcd').val('{{ old("eventcd")?old("eventcd"):$emp_event_cd }}'); </script>
            </div>
            <div class="col-sm-6">
              <label for="exampleInputEmail1">Hotel Name : </label>
              <select class="form-control form-control-sm hotel_cd" name="hotel_cd" onchange="javascript:be.getCategory(this);" data-link="{{ route('gethtlcategory') }}" data-hotel_cd="{{ old('hotel_cd')?old('hotel_cd'):$hotel_cd }}" required>
                @if(!empty($hotel_list))
                  @if(count($hotel_list) > 1)
                    <option value="">Select hotel</option>
                  @endif
                  @foreach($hotel_list as $hotel)
                    <option value="{{ $hotel->htl_id }}"  {{ $emp_hotel_cd == $hotel->htl_id?'selected':''  }}>{{ $hotel->hotel_name }}</option>
                  @endforeach
                @endif
              </select>
              <script> $('.hotel_cd').val('{{ old("hotel_cd")?old("hotel_cd"):$hotel_cd }}'); </script>
            </div>
            <div class="col-sm-6">
              <label for="exampleInputEmail1">Room Category : </label>
              <select class="form-control form-control-sm room_categorycd" name="room_categorycd" onchange="be.getShareRoom(this);" data-link="{{ route('geteventemp') }}" data-cat_cd="{{ old('room_categorycd')?old('room_categorycd'):$room_categorycd }}" required>
                <option value="">Select category</option>
              </select>
            </div>
            <div class="col-sm-6">
              <label>Share Room With : </label>
              <select class="form-control form-control-sm select2 td_empShareRm emp_ShareRm" name="emp_ShareRm">
                <option value="">Select employee</option>
              </select>
            </div>   
            <div class="col-sm-6">
                <label>Hotel Check-in Date : </label>
                <input type="datetime-local" class="form-control assign_check_in" name="assign_check_in" value="{{ old('assign_check_in')?old('assign_check_in'):@$assign_check_in }}">
            </div>   
            <div class="col-sm-6">
                <label>Hotel Check-out Date : </label>
                <input type="datetime-local" class="form-control assign_check_out" name="assign_check_out" value="{{ old('assign_check_out')?old('assign_check_out'):@$assign_check_out }}">
            </div> 
          </div>
        </div>
        <h4 class="bg-primary pl-3 mb-0">Flight Details</h4>
        <div class="card-body pt-0">
          <div class="row divFlightInfo">
            @if($page_type == 'driver')
             <div class="col-sm-6">
                @if(!empty(trim(@$arv_flight_number)))
                <p class="text-danger m-0">Arrival flight details filled by user.</p>
                @endif
             </div>
             <div class="col-sm-6">
                @if(!empty(trim(@$arv_flight_number)))
                <p class="text-danger m-0">Departure flight details filled by user.</p>
                @endif
             </div>
            @endif
            <div class="col-sm-6 pl-0 pr-0">
              <div class="col-sm-12">
                <label>Arrival Flight Name : </label>
                <input type="text" class="form-control arv_flight_name" name="arv_flight_name" value="{{ old('arv_flight_name')?old('arv_flight_name'):@$arv_flight_name }}" placeholder="Arrival flight name">
              </div>
              <div class="col-sm-12">
                <label>Arrival Flight Number : </label>
                <input type="text" class="form-control arv_flight_number" name="arv_flight_number" value="{{ old('arv_flight_number')?old('arv_flight_number'):@$arv_flight_number }}" placeholder="Arrival flight number">
              </div>     
              <div class="col-sm-12">
                <label>Arrival Date & Time : </label>
                <input type="datetime-local" class="form-control arv_date_time" name="arv_date_time" value="{{ old('arv_date_time')?old('arv_date_time'):@$arv_date_time }}">
              </div>  
              <div class="col-sm-12">
                <label>Arrival Flight Location : </label>
                <input type="text" class="form-control arv_flight_location" name="arv_flight_location" value="{{ old('arv_flight_location')?old('arv_flight_location'):@$arv_flight_location }}" placeholder="Arrival flight location">
              </div>   
            </div>  
            <div class="col-sm-6 pl-0 pr-0">
              <div class="col-sm-12">
                <label>Departure Flight Name : </label>
                <input type="text" class="form-control dpt_flight_name" name="dpt_flight_name" value="{{ old('dpt_flight_name')?old('dpt_flight_name'):@$dpt_flight_name }}" placeholder="Departure flight name">
              </div>
              <div class="col-sm-12">
                <label>Departure Flight Number : </label>
                <input type="text" class="form-control dpt_flight_number" name="dpt_flight_number" value="{{ old('dpt_flight_number')?old('dpt_flight_number'):@$dpt_flight_number }}" placeholder="Departure flight number">
              </div>     
              <div class="col-sm-12">
                <label>Departure Date & Time : </label>
                <input type="datetime-local" class="form-control dpt_date_time" name="dpt_date_time" value="{{ old('dpt_date_time')?old('dpt_date_time'):@$dpt_date_time }}">
              </div> 
              <div class="col-sm-12">
                <label>Departure Flight Location : </label>
                <input type="text" class="form-control dpt_flight_location" name="dpt_flight_location" value="{{ old('dpt_flight_location')?old('dpt_flight_location'):@$dpt_flight_location }}" placeholder="Departure flight location">
              </div> 
            </div>
          </div>
        </div>
        <h4 class="bg-primary pl-3 mb-0">Driver & Vehicle Details</h4>
        <div class="card-body pt-0">
          <div class="row divDriverInfo">
            <div class="col-sm-6">
              <label>Driver Number : </label>
              <input type="text" class="form-control drvr_number int" name="drvr_number" value="{{ old('drvr_number')?old('drvr_number'):@$drvr_number }}" placeholder="Driver number" maxlength="10">
            </div>  
            <div class="col-sm-6">
              <label>Vehicle Details : </label>
              <input type="text" class="form-control vehicle_details" name="vehicle_details" value="{{ old('vehicle_details')?old('vehicle_details'):@$vehicle_details }}" placeholder="Vehicle Details">
            </div>
          </div>
          @if($page_type == 'hotel')
          <div class="row hotelChngReqInfo">
            <hr class="w-100 m-0 mt-2 p-0" style="border: 1px solid #ccc;">
            <div class="col-sm-6">
              <label class="w-100">Hotel Name & Room Type : </label>
              <p>{{ @$event->hotel_name }} ({{ @$event->hotel_category }})</p>
              <p></p>
            </div>
            <div class="col-sm-6">
              <label class="w-100">Instruction : </label>
              <p>{{ @$event->req_chng_instraction }}</p>
            </div>
            <label class="col-sm-2">Remarks : </label>
            <input type="text" class="form-control form-control-sm col-sm-10 location" name="remarks" placeholder=" Enter Remarks">
          </div>
          @endif
        </div>
        @endif
        <!-- /.card-body -->
        <div class="card-footer">
          @if($page_type == 'hotel')
          <button type="submit" name="change_stataus" value="2" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
          <button type="submit" name="change_stataus" value="3" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
          @elseif($page_type == 'driver')
          <button type="submit" name="change_stataus" value="4" class="btn btn-success"><i class="fa fa-car"></i> Assign Driver</button>
          @else
          <button type="submit" name="submit" class="btn btn-success btnUsrSubmit"><i class="fa fa-save"></i> {{ $btn_name }}</button>
          @endif
        </div>
      </form>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('javascript')
<script src="{{ asset('pages/others/bookevent.js') }}"></script>
<script type="text/javascript">
var page_type = '{{ @$page_type }} ';
if(page_type.trim() == 'hotel' || page_type.trim() == 'driver'){
  $('.userInfo').find('input, select').attr('disabled', 'disabled');
  $('.divFlightInfo').find('input, select').attr('disabled', 'disabled');
}
var findEV = $('body').find('.eventcd').length;
if(parseInt(findEV) > 0){
  var opt_len = $('.eventcd').find('option').length;
  if(opt_len == 1){
    $('.eventcd').find('option:eq(0)').attr('selected', 'selected');
    var emp_evv_id = $('.emp_evv_id').val();
    if(parseInt(emp_evv_id) <= 0 || emp_evv_id == ''){
      $('.eventcd').trigger('change');
    }
  }
}
</script>
@endsection