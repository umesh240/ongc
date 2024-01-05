@extends('layouts.app')
@php
  $pageNm = 'Check-In/Out Summery';
  $hotel_cd = $emp_event_cd = '';
  $to_date = $fr_date = date('Y-m-d H:i:s');
  if(@$eventcd > 0){
    $emp_event_cd = $eventcd;
    $hotel_cd = $hotelcd;
    //echo '<pre>';  print_r($report_data); die;
    $to_date = $todate; 
    $fr_date = $frdate;  
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
          <form action="{{ route('room_availability_show') }}" method="post" class="searchReport">
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
                    @php 
                    $frDate = date('Y-m-d H:i:s', strtotime($event->event_datefr ." - 4 day"));
                    $toDate = date('Y-m-d H:i:s', strtotime($event->event_dateto ." + 4 day"));
                    @endphp
                    <option value="{{ $event->ev_id }}" data-frdt="{{ $frDate }}"  data-todt="{{ $toDate }}" {{ $emp_event_cd == $event->ev_id?'selected':''  }}>
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
            <div class="col-sm-3">
              <label for="exampleInputEmail1">From Date</label>
              <input type="datetime-local" class="form-control form-control-sm fr_date" name="fr_date" value="{{ @$fr_date }}" disabled>
            </div>
            <div class="col-sm-3">
              <label for="exampleInputEmail1">To Date</label>
              <input type="datetime-local" class="form-control form-control-sm to_date" name="to_date" value="{{ @$to_date }}" disabled>
            </div>
            <div class="col-sm-12 mt-3">
              <button type="submit" name="submit_btn" value="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i> Filter</button>
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
                <th>Room Category</th>
              </tr>
            </thead>
            <tbody>
              @php 
                $keyy = 0; 
                $htlArr = [];
              @endphp
              @for($i = 0; $i < 1; $i++)
              @foreach ($report_data as $key => $data)
                @php
                  $string = 'htl_'.$data->htl_idd;
                  if (array_key_exists($string, $htlArr)) {
                    $htlArr[$string] = $string;
                    $keyy = 0; 
                    echo '<tr><td colspan="2">'.$data->hotel_name.'</td></tr>';
                  }
                @endphp
                <tr style="">
                  <td>{{ ($keyy+1) }}</td>
                  <td>{{ $data->hotel_category }}</td>
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