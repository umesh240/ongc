@extends('layouts.app')
@php
  $pageNm = 'Check-In/Out Summery';
  $hotel_cd = $emp_event_cd = '';
  
  if(@$eventcd > 0){
    $emp_event_cd = $eventcd;
    $hotel_cd = $hotelcd;
    //echo '<pre>';  print_r($report_data); die;
  }
@endphp
@section('title', $pageNm)
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $pageNm }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{ $pageNm }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ $pageNm }}</h3>
        </div>
        <div class="card-body p-2">
          <form action="{{ route('check_inout_summery_show') }}" method="post" class="searchReport">
            @csrf
          <div class="row">
            <div class="col-sm-3">
              <label for="exampleInputEmail1">Event Name</label>
              <select class="form-control form-control-sm eventcd" name="eventcd" onchange="rpt.getHotels(this);" data-link="{{ route('get_hotel') }}" required>
                @if(!empty($event_list))
                  @if(count($event_list) > 1)
                    <option value="">Select event</option>
                  @endif
                  @foreach($event_list as $event)
                    <option value="{{ $event->ev_id }}" {{ $emp_event_cd == $event->ev_id?'selected':''  }}>
                    {{ $event->event_name.' ('.date('d/m/Y', strtotime($event->event_datefr)).' - '.date('d/m/Y', strtotime($event->event_dateto)).')' }}
                    </option>
                  @endforeach
                @endif
              </select>
              <script> $('.eventcd').val('{{ old("eventcd")?old("eventcd"):$emp_event_cd }}'); </script>
            </div>
            <div class="col-sm-3">
              <label for="exampleInputEmail1">Hotel Name</label>
              <select class="form-control form-control-sm hotel_cd" name="hotel_cd" data-hotel_cd="{{ $hotel_cd }}"></select>
            </div>
            <div class="col-sm-2">
              <label for="exampleInputEmail1">&nbsp;</label>
              <button type="submit" name="submit_btn" value="submit" class="btn btn-sm btn-block btn-success"><i class="fa fa-search"></i> Filter</button>
            </div>
            <div class="col-sm-4">
              <label for="exampleInputEmail1">&nbsp;</label>
              <div id="export-button-container"></div>
            </div>
          </div>
          </form>
        </div>
        @if($emp_event_cd > 0)
        @php
        
        $event_name = @$report_data[0]->eventDetails->event_name;
        $hotel_name = @$report_data[0]->hotelDetails->hotel_name;
        $printnm = $pageNm." \n Event : ".$event_name;
        if($hotel_cd > 0){
          $printnm = $printnm." \n Hotel : ".$hotel_name;
        }
        $printnm = $printnm." \n Print Date : ".date('d-m-Y h i s A');
        @endphp
        <div class="card-footer exportData" id="exportData" >
          <table class="table table-bordred tableExport" width="100%" data-pgNam="{{ $printnm }}" style="font-size: 13px;">
            <thead>
              <tr class="bg-dark">
                <th>Sr.No.</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Level</th>
                <th>Email Id</th>
                <th>Mobile No.</th>
                <th>Hotel Name</th>
                <th>Room Category</th>
                <th width="8%">Check-In</th>
                <th width="8%">Check-Out</th>
              </tr>
            </thead>
            <tbody>
              @php $keyy = 0; @endphp
              @for($i = 0; $i < 1; $i++)
              @foreach ($report_data as $key => $data)
                @php
                  $check_in = $data->check_in;
                  $check_out = $data->check_out;
                  $check_inDt = $check_outDt = '';
                  $color = 'background-color:#ea000017;';
                  if(trim($check_in) != null){
                    $check_inDt = date('d/m/Y h:iA', strtotime($check_in));
                    $color = '';
                  }
                  if(trim($check_in) != null){
                    $check_outDt = date('d/m/Y h:iA', strtotime($check_out));
                  }
                @endphp
                <tr style="{{ $color  }}">
                  <td>{{ ($key+1) }}</td>
                  <td>{{ $data->userDetails->name }}</td>
                  <td>{{ $data->userDetails->designation }}</td>
                  <td>{{ $data->userDetails->level }}</td>
                  <td>{{ $data->userDetails->email }}</td>
                  <td>{{ $data->userDetails->mobile }}</td>
                  <td>{{ $data->hotelDetails->hotel_name }}</td>
                  <td>{{ $data->categoryDetails->hotel_category }}</td>
                  <td>{{ $check_inDt }}</td>
                  <td>{{ $check_outDt }}</td>
                </tr>
              @endforeach
              @endfor
            </tbody>
          </table>
        </div>
        <!-- /.card-footer-->
        @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('javascript')
<script src="{{ asset('pages/others/reports.js') }}"></script>
<script type="text/javascript">

</script>
@endsection