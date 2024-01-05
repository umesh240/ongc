@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Book Event ';
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
            <button onclick="window.location='{{ route("bookevent.ae", ["ae" => "add"]) }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Add New</button>
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
             {{ $bookevents_list->links('vendor.pagination.search', ['routename' => "bookevent", 'list_length' => $list_length, 'list_search' => $list_search, 'events_list' => @$events_list, 'event_cd' => $event_code]) }}
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr>
                  <th>Event Name</th>
                  <th>Employee Name</th>
                  <th>CPF No.</th>
                  <th>Mobile No.</th>
                  <th>Email-Id</th>
                  <th>Hotel</th>
                  <th>Caregory</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody>
              @php $cnt = 0; @endphp 
              @foreach ($bookevents_list as $row) 
              @php $cnt++; @endphp 
              <tr style="">
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->event_name; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->name; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->cpf_no; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->mobile; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->email; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->hotel_nm; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $row->hotel_category; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                  <button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("bookevent.ae", ["id" => $row->emp_ev_book_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('bookevent.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$row->emp_ev_book_id}}');"><i class="fa fa-trash"></i> Trash</button>
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
            {{ $bookevents_list->links('vendor.pagination.bootstrap-4') }}
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