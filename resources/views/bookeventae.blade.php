@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Book Event';
  //echo '<pre>'; print_r($event_emp_info); die;
@endphp
@section('title', $pageNm)
@section('content')
<style>
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $pageNm }}<font class="activePg"></font></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr class="w-100 mt-0">
    <!-- /.content-header -->
    @php 
      $cd = 0;
      $btnNm = "Save";
      $ev_book_id = @$event_emp_info->event_book_id;
      $emp_ev_book_id = @$event_emp_info->emp_ev_book_id;
      $emp_event_cd = @$event_emp_info->emp_event_cd;
      $emp_hotel_cd = @$event_emp_info->emp_hotel_cd;
      $emp_hotel_cat_cd = @$event_emp_info->emp_hotel_cat_cd;
      if($ev_book_id > 0){
        $btnNm = "Update";
        $cd = $ev_book_id;
      }
    @endphp
    <!-- Main content -->
    <div class="content">
      <div class="card card-primary">
        <form action="{{ route('bookevent.save') }}" method="post" class="frmBookEventSave">
          @csrf
          <input type="hidden" class="cd" name="cd" value="{{ @$cd }}" />
          <div class="card-header bg-primary">
            <h3 class="card-title">Book Event</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-4">
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
              <div class="col-sm-4">
                <label for="exampleInputEmail1">Hotel Name</label>
                <select class="form-control hotel_cd" name="hotel_cd" onchange="javascript:be.getCategory(this);" data-link="{{ route('gethtlcategory') }}" required>
                  @if(!empty($hotel_list))
                    @if(count($hotel_list) > 1)
                      <option value="">Select hotel</option>
                    @endif
                    @foreach($hotel_list as $hotel)
                      <option value="{{ $hotel->htl_id }}"  {{ $emp_hotel_cd == $hotel->htl_id?'selected':''  }}>{{ $hotel->hotel_name }}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="col-sm-4">
                <label for="exampleInputEmail1">Room Category</label>
                <select class="form-control room_categorycd" name="room_categorycd" onchange="be.getShareRoom(this);" data-link="{{ route('geteventemp') }}" data-cat_cd="{{ $emp_hotel_cat_cd }}" required>
                  <option value="">Select category</option>
                </select>
              </div>
              <div class="col-sm-12 mt-3">
                <table class="table table-bordered" width="100%">
                  <thead>
                    <tr class="bg-dark">
                      <th style="padding-top:1px; padding-bottom:1px; width:35%;">Employe Name</th>
                      <th style="padding-top:1px; padding-bottom:1px; width:15%;">Level</th>
                      <th style="padding-top:1px; padding-bottom:1px; width:20%;">Designation</th>
                      <th style="padding-top:1px; padding-bottom:1px; width:20%;">Share Room With</th>
                      <th style="padding-top:1px; padding-bottom:1px; width:20%;">Action</th>
                    </tr>
                    <tr class="tHeadAdd" data-linkDel="{{ route('bookevent.delete') }}">
                      <td style="padding-top:1px; padding-bottom:1px;">
                        <select class="form-control form-control-sm select2 td_empId" onchange="be.setUserInfo(this);">
                          <option value="">Select employee</option>
                          @foreach($employee_list as $emp)
                            <option data-level="{{ $emp->level }}" data-desi="{{ $emp->designation }}" data-cate="{{ $emp->category }}" value="{{ $emp->id }}">{{ $emp->cpf_no.' - '.$emp->name }}</option>
                          @endforeach
                        </select>
                      </td>
                      <td style="padding-top:1px; padding-bottom:1px;" class="td_empLevel"></td>
                      <td style="padding-top:1px; padding-bottom:1px;" class="td_empDesig"></td>
                      <td style="padding-top:1px; padding-bottom:1px;">
                        <select class="form-control form-control-sm select2 td_empShareRm"></select>
                      </td>
                      <td style="padding-top:1px; padding-bottom:1px;">
                        <button type="button" class="btn btn-sm btn-success btnAdUpd" onclick="be.addMore(this);" data-link="{{ route('ckExistEmp') }}"><i class="fa fa-plus"></i> <font class="tdAETxt">Add</font></button>
                      </td>
                    </tr>
                  </thead>
                  <tbody class="tBodyList">
                  @if($emp_ev_book_id > 0)
                  @php
                  $info = $event_emp_info->emp_ev_book_id.'^'.$event_emp_info->emp_cd.'^'.$event_emp_info->share_room_with_empcd;
                  @endphp
                  <tr class="trEmp">			
                    <td class="pt-0 pb-0">{{ $event_emp_info->ed_emp_cpf_no.' - '.$event_emp_info->ed_emp_name }}</td>			
                    <td class="pt-0 pb-0">{{ $event_emp_info->level }}</td>			
                    <td class="pt-0 pb-0">{{ $event_emp_info->designation }}</td>			
                    <td class="pt-0 pb-0">{{ $event_emp_info->share_room_with_empcd > 0 ? $event_emp_info->ed_emp_share_cpf_no.' - '.$event_emp_info->ed_emp_share_name : '' }}</td>			
                    <td class="pt-0 pb-0" style="text-align: center;"> 				
                      <input type="hidden" class="user_info" name="user_info[]" data-idd="{{ $event_emp_info->emp_cd }}" value="{{ $info }}">				
                      <button type="button" class="btn btn-xs btn-info" onclick="be.edit(this);">Edit</button>				
                      <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('bookevent.delete') }}" onclick="recordsDelete(this, '{{$event_emp_info->emp_ev_book_id}}');">Delete</button>			
                    </td>		
                  </tr>
                  @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="Submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> {{ $btnNm }}</button>
          </div>
        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('javascript')
<script src="{{ asset('pages/others/bookevent.js') }}"></script>
@endsection