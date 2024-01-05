@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Event Master ';
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
          <h1 class="m-0">{{ $pageNm }}<font class="activePg">Add</font></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <button onclick="window.location='{{ route("event") }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-list"></i> List</button>
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr class="w-100 mt-0">
  <!-- /.content-header -->
  @php
    $airports = [];
    $btn_name = "Save";
    $event_city = '';
    $cd = 0;
    $event_datefr = $event_dateto = $today = date('Y-m-d H:i');
    if(@$event->ev_id > 0){
      $cd = @$event->ev_id;
      $airports = $event->airports;
      $airports = json_decode($airports);

      $event_datefr = $event->event_datefr;
      $event_dateto = $event->event_datefr;
      $event_city = @$event->event_city;
      $btn_name = "Update";
    }
  @endphp
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ $pageNm }}</h3>
      </div>
      <form action="{{ route('event.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cd" value="{{ @$event->ev_id }}" class="cd">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Event Name:</label>
            <input type="text" class="form-control form-control-sm event_name" name="event_name" value="{{ old('event_name')?old('event_name'):@$event->event_name }}" placeholder=" Event name" required>
          </div>
          <div class="col-sm-6">
            <label>From Date:</label>
            <input type="datetime-local" class="form-control form-control-sm event_datefr" name="event_datefr" value="{{ old('event_datefr')?old('event_datefr'):@$event_datefr }}" required>
            
          </div>

          <div class="col-sm-6">
            <label>To Date:</label>
            <input type="datetime-local" class="form-control form-control-sm event_dateto" name="event_dateto" value="{{ old('event_dateto')?old('event_dateto'):@$event_dateto }}" required> 
          </div>

          <div class="col-sm-3">
            <label>Event City:</label>
            <input type="text" class="form-control form-control-sm event_city" name="event_city" value="{{ old('event_city')?old('event_city'):@$event_city  }}" placeholder=" Event city" required>
          </div>
          <div class="col-sm-9">
            <label>Event Address:</label>
            <input type="text" class="form-control form-control-sm event_location" name="event_location" value="{{ old('event_location')?old('event_location'):@$event->event_location }}" placeholder=" Event location" required>
          </div>
          <div class="col-sm-12">
            <label>Event Geo Location:</label>
            <input type="text" class="form-control form-control-sm event_mapurl lc" name="event_mapurl" value="{{ old('event_mapurl')?old('event_mapurl'):@$event->event_mapurl }}" placeholder=" Event geo location (map) url" required>
          </div>
          <div class="col-sm-12">
            <label>Event Details (In Pdf):</label>
            <input type="file" class="form-control form-control-sm event_details" name="event_details" accept=".pdf">
          </div>
        </div>
      </div>
      <h4 class="bg-primary pl-3 mb-0">Airport(s) Location</h4>
      <div class="card-body pt-0">
        @for($i = 0; $i < 3; $i++)
        @php
          $airport_name       = @$airports[$i]->airport_name;
          $airport_location   = @$airports[$i]->airport_location;
          $airport_photo   = @$airports[$i]->airport_photo;
        @endphp
        <div class="row" style="border-bottom: 1px solid #ccc; padding-bottom: 8px;">
          <input type="hidden" name="old_image_{{ $i }}" value="{{ $airport_photo }}">
          <label class="col-sm-12 mt-0" style="font-weight: 500; font-size: 20px;">Airport Location {{ $i+1 }}:</label>
          <div class="col-sm-6">
            <label>Airport Name:</label>
            <input type="text" class="form-control form-control-sm airport_name" name="airport_name_{{ $i }}" value="{{ $airport_name }}" placeholder=" Airport name" {{ $i==0?"required":"" }}>
          </div>
          <div class="col-sm-6">
            <label>Airport Photo:</label>
            <input type="file" class="form-control form-control-sm airport_photo" name="airport_photo_{{ $i }}" value="" placeholder=" Airport Photo" accept=".jpeg, .jpg, .png"  {{ $i==0 && $cd <= 0?"required":"" }}>
          </div>
          <div class="col-sm-12">
            <label>Airport Geo Location:</label>
            <input type="text" class="form-control form-control-sm airport_location" name="airport_location_{{ $i }}" value="{{ $airport_location }}" placeholder=" Airport geo location"  {{ $i==0?"required":"" }}>
          </div>
        </div>
        @endfor
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> {{ $btn_name }}</button>
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
<script type="text/javascript">

</script>
@endsection