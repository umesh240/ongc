@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Import Event Booking';
  $emp_event_cd = 0;
  if(@$eventcd > 0){
    $emp_event_cd = $eventcd;
  }
  //echo "-----------------------------------------------------------------";
  //print_r(@$excelData);
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
            <h1 class="m-0">{{ $pageNm }}<font class="activePg"></font></h1>
          </div>
          <div class="col-sm-6">
            <a href="{{ asset('/storage/app/event_book_fromat.csv') }}"  class="btn btn-success btn-sm float-right" download>Export Format</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr class="w-100 mt-0">
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-primary">
        <div class="card-header ">
          <h3 class="card-title">Import Event</h3>
        </div>
        @if(@$showlist == 0 || @$showlist == '')
        <form action="{{ route('import_bookevent.show') }}" method="post" class="frmBookEventShow" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <label for="exampleInputEmail1">Event Name</label>
                <select class="form-control eventcd" name="eventcd" required>
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
              </div>
              <div class="col-sm-6">
                <label for="exampleInputEmail1">Excel File</label>
                <div class="custom-file">
                  <input type="file" name="excel_file" class="custom-file-input custom-file-input excel_file" id="customFile">
                  <label class="custom-file-label" for="customFile" style="margin-top: 0 !important;">Choose file</label>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Submit</button>
          </div>
        </form>
        @endif
        <!-- /.1st card-footer-->
        @if(@$showlist == 1)
        <!-- 2nd card-footer start -->
        <form action="{{ route('import_bookevent.save') }}" method="post" class="frmBookEventSave">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <b>Event Name</b> : {{ $event_info->event_name }}
              </div>
              <div class="col-sm-3">
                <b>Date</b> : {{ date('d/m/Y', strtotime($event_info->event_datefr)) }} - {{ date('d/m/Y', strtotime($event_info->event_dateto)) }}
              </div>
              <div class="col-sm-4">
                <b>Location</b> : {{ $event_info->event_location }}
              </div>
              <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-sm btn-success btnSubmit"><i class="fa fa-save"></i> Submit</button>
                <button type="button" name="reset" class="btn btn-sm btn-primary" onclick="linkClick(this);" data-link="{{ route('import_bookevent') }}"><i class="fa fa-reset"></i> Refresh</button>
              </div>
              <hr class="w-100 m-2">
              <input type="hidden" class="bok_ev_id" name="bok_ev_id" value="{{ $event_info->ev_id }}" />
              <div class="col-sm-12">
                <table class="table table-bordered table-striped tblResponsiv" style="font-size:16px;">
                  <thead>
                    <tr>
                      <th>Sno</th>
                      <th>Booking</th>
                      <th>Status</th>
                      <th>CPF No.</th>
                      <th>Name</th>
                      <th>Level</th>
                      <th>Designation</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Category</th>
                      <th>Location</th>
                      <th>From</th>
                      <th>To</th>
                      <th>Hotel</th>
                      <th>Room Category</th>
                      <th>Comments</th>
                      <th>Arr. Date & Time</th>
                      <th>Arr. Flight No.</th>
                      <th>Dep. Date & Time</th>
                      <th>Dep. Flight No.</th>
                      <th>Vehicle Details</th>
                      <th>Driver Number</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php 
                  $rowStatusTitle = array(0 => 'New Booking Entry', 1 => 'Booking Update Request', 2 => 'Email Same But CPF No. Different.');
                  $rowStatusTxt = array(0 => 'New', 1 => 'Update', 2 => 'Mismatch');
                  $rowStatusClr = array(0 => 'success', 1 => 'primary', 2 => 'danger');
                  //echo '<pre>'; print_r($excelRows); die;
                  @endphp 
                  
                  @foreach($excelRows as $key => $row)
                  @php 
                  $arrv_dttm = $row[14].' '.$row[15];
                  $dept_dttm = $row[17].' '.$row[18];

                  $row_status = $row[26];
                  $rowInfo = implode(',', $row);
                  $rowInfo = trim($rowInfo,",");
                  @endphp 
                  <tr class="trrEB">
                      <td>{{ ($key + 1) }}</td>
                      <td class="text-{{ $rowStatusClr[$row_status] }}" title="{{ $rowStatusTitle[$row_status] }}">
                        {{ $rowStatusTxt[$row_status] }}
                      </td>
                      <td class="tdStatus"></td>
                      <td>{{ $row[1] }}
                        <input type="hidden" name="event_book[]" class="event_book" value="{{ $rowInfo }}" />
                      </td>
                      <td>{{ $row[2] }}</td>
                      <td>{{ $row[3] }}</td>
                      <td>{{ $row[4] }}</td>
                      <td>{{ $row[5] }}</td>
                      <td>{{ $row[6] }}</td>
                      <td>{{ $row[8] }}</td>
                      <td>{{ $row[7] }}</td>
                      <td>{{ $row[9] }}</td>
                      <td>{{ $row[10] }}</td>
                      <td>{{ $row[11] }}</td>
                      <td>{{ $row[12] }}</td>
                      <td>{{ $row[13] }}</td>
                      <td>{{ $arrv_dttm }}</td>
                      <td>{{ $row[16] }}</td>
                      <td>{{ $dept_dttm }}</td>
                      <td>{{ $row[19] }}</td>
                      <td>{{ $row[20] }}</td>
                      <td>{{ $row[21] }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-sm btn-success btnSubmit"><i class="fa fa-save"></i> Submit</button>
            <button type="button" name="reset" class="btn btn-sm btn-primary" onclick="linkClick(this);" data-link="{{ route('import_bookevent') }}"><i class="fa fa-reset"></i> Refresh</button>
          </div>
        </form>
        <!-- /.2nd card-footer end -->
        @endif
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

@section('javascript')
<script src="{{ asset('pages/others/importbookevent.js') }}"></script>
@endsection