@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Hotel Master ';
  //echo '<pre>'; print_r($hotel_list); die;
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
            <h1 class="m-0">{{ $pageNm }}<font class="activePg">List</font></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <button onclick="window.location='{{ route("hotel.ae", ["ae" => "add"]) }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Add New</button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr class="w-100 mt-0">
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
             {{ $hotel_list->links('vendor.pagination.search', ['routename' => "hotel", 'list_length' => $list_length, 'list_search' => $list_search, 'events_list' => @$events_list, 'event_cd' => $event_code]) }}
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr>
                  <th>Hotel Name</th>
                  <th>Hotel Address</th>
                  <th>No. of Category</th>
                  <th>No. of Rooms</th>
                  <th>Event Name</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody>
              @php $cnt = 0; 
              @endphp 
              @foreach ($hotel_list as $record) 
              @php $cnt++; @endphp 
              <tr style="">
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $record->hotel_name; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $record->hotel_address }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $record->category_count }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $record->rooms_count }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;" class="{{ @$record->actv_event == 2?'text-danger':'' }}" title="{{ @$record->actv_event == 2?'Expired Event':'' }}" data-toggle="tooltip" data-placement="left">{{ @$record->event_name }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                  <button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("hotel.ae", ["id" => $record->htl_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('hotel.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$record->htl_id}}');"><i class="fa fa-trash"></i> Trash</button>
                </td>
              </tr>
              @endforeach
              @php if($cnt == 0){
                echo '<tr><td colspan="5">No record found.</td></tr>';
              } 
              @endphp 
              </tbody>
            </table>
          </div>
          <div class="col-lg-12">
            {{ $hotel_list->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('javascript')

@endsection