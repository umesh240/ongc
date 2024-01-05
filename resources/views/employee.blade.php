@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Employee Master ';
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
            <button onclick="window.location='{{ route("employee.ae", ["ae" => "add"]) }}';" class="btn btn-sm btn-success float-right mr-1"><i class="fa fa-plus"></i> Add New User</button>
            <button onclick="window.location='{{ route("employee.ae", ["ae" => "event"]) }}';" class="btn btn-sm btn-success float-right mr-1"><i class="fa fa-address-card"></i> Add New Event</button>
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
             {{ $employee_list->links('vendor.pagination.search', ['routename' => "employee", 'list_length' => $list_length, 'list_search' => $list_search, 'events_list' => @$events_list, 'event_cd' => $event_code, 'level_list' => @$level_list, 'level_code' => $level_code, 'hotel_list' => @$hotel_list, 'hotel_code' => $hotel_code]) }}
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr>
                  <th>CPF No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Level</th>
                  <th>Designation</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody>
              @php $cnt = 0; @endphp 
              @foreach ($employee_list as $employee) 
              @php $cnt++; @endphp 
              <tr style="">
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->cpf_no; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->name; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->email; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->mobile; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->level; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $employee->designation; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                  @if(@$event_code > 0)
                  <button type="button" class="btn btn-xs btn-success" onclick="window.location='{{ route("employee.ae", ["id" => $employee->id, "event_id" => @$employee->emp_ev_book_id, "ae" => "event"]) }}';" title="View/Edit User's Event"><i class="fa fa-eye"></i></button>
                  @else
                  <button type="button" class="btn btn-xs btn-success" onclick="window.location='{{ route("employee.ae", ["id" => $employee->id, "event_id" => @$employee->emp_ev_book_id, "ae" => "edit"]) }}';" title="View/Edit User"><i class="fa fa-eye"></i></button>
                  <button type="button" class="btn btn-xs btn-info" onclick="window.location='{{ route("employee.ae", ["id" => $employee->id, "event_id" => @$employee->emp_ev_book_id, "ae" => "event"]) }}';" title="Add New Event"><i class="fa fa-address-card"></i></button>
                  @endif
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('employee.delete') }}" onclick="recordsDelete(this, '{{$employee->id}}', '{{ @$employee->emp_ev_book_id }}');" title="Delete"><i class="fa fa-trash"></i></button>
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
            {{ $employee_list->links('vendor.pagination.bootstrap-4', ['routename' => "employee", 'event_cd' => $event_code, 'level_code' => $level_code, 'hotel_code' => $hotel_code, 'list_length' => $list_length, 'list_search' => $list_search]) }}
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