@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Hotel Master ';
  $emp_event_cd = '';
@endphp
@section('title', $pageNm)
@section('content')
<style>
  .tblCat td{
    padding-top:2px; padding-bottom:2px; 
  }
  .form-group{ margin-bottom: 6px;  }
  .img-wraps {
    position: relative;
    display: inline-block;
    
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 5px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
     
    color: #000;
    font-weight: bold;
    cursor: pointer;
    
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
    border:1px solid red;
}
.img-wraps .closes:hover {
    background-color: #f00; color: #FFF; border:1px solid #000;
}
.img-wraps:hover .closes {
    opacity: 1;
}
.img-responsive{  width: 130px; height: 130px; margin:4px; border: 1px solid #ccc;  }
.select2-results__option[aria-disabled="true"] { display: none; }
</style>
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
    $btn_name = "Save";
    $hospitality_fpr = $logistic_fpr = '';
    $event_datefr = $event_dateto = $today = date('Y-m-d H:i');
    if(@$hotel->htl_id > 0){
      $btn_name = "Update";

      $emp_event_cd = old('eventcd')?@old('eventcd'):@$hotel->evv_id;
      $hospitality_fpr = @$hotel->hospitality_fpr;
      $logistic_fpr    = @$hotel->logistic_fpr;
    }
  @endphp
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">{{ $pageNm }}</h3>
      </div>
      <form action="{{ route('hotel.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cd" value="{{ @$hotel->htl_id }}" class="cd">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Hotel For Event</label>
            <select class="form-control form-control-sm eventcd" name="eventcd" required>
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
          <div class="form-group">
            <label>Event Location From Hotel</label>
            <div class="input-group input-group-sm">
              <div class="input-group-prepend">
                <span class="input-group-text">Distance (In KM)</span>
              </div>
              <input type="text" class="form-control form-control-sm float distance" name="distance" value="{{ old('distance')?@old('distance'):@$hotel->distance }}" placeholder=" Enter Geo Location" >
              <div class="input-group-prepend">
                <span class="input-group-text">Time (In Mins)</span>
              </div>
              <input type="text" class="form-control form-control-sm int minutes" name="minutes" value="{{ old('minutes')?@old('minutes'):@$hotel->minutes }}" placeholder=" Enter Geo Location" >
            </div>
          </div>

          <div class="form-group">
            <label>Hotel Name</label>
            <input type="text" class="form-control form-control-sm hotel_name" name="hotel_name" value="{{ old('hotel_name')?@old('hotel_name'):@$hotel->hotel_name }}" placeholder="Enter Hotel Name" required>
          </div>

          <div class="form-group">
            <label>Hotel Address</label>
            <input type="text" class="form-control form-control-sm hotel_address" name="hotel_address" value="{{ old('hotel_address')?@old('hotel_address'):@$hotel->hotel_address }}" placeholder=" Enter Hotel Address">
          </div>
         
          <div class="form-group">
            <label>Hotel Geo Location</label>
            <input type="text" class="form-control form-control-sm hotel_geolocation" name="hotel_geolocation" value="{{ old('hotel_geolocation')?@old('hotel_geolocation'):@$hotel->hotel_geolocation }}" placeholder=" Enter Geo Location">
          </div>

          <div class="form-group">
            <label>Hotel Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input hotel_image" name="hotel_image[]" multiple accept=".jpg, .jpeg, .png">
                <label class="custom-file-label">Choose file</label>
              </div>
            </div>
          </div>
          @if(trim(@$hotel->hotel_image) != '')
            <div class="form-group divDelImg">
            @php
              $hotel_image = $hotel->hotel_image;
              $hotel_imageAll = explode('||', $hotel_image);
            @endphp
            @foreach($hotel_imageAll as $img)
            <div class="img-wraps">
              <span class="closes" title="Delete" onclick="htl.delImage(this, '{{ $img }}')">×</span>
              <img class="img-responsive" src="{{ asset('storage/app/hotel_image/'.$img) }}">
            </div>
            @endforeach
            </div>
          @endif
        </div>
        <div class="card-body">
          <table class="table table-bordered tblCat">
            <thead class="">
              <tr class="bg-dark">
                <th style="width: 50%;" class="pt-1 pb-1">Room Type</th>
                <th style="width: 15%;" class="pt-1 pb-1">Number of rooms</th>
                <th style="width: 20%;" class="pt-1 pb-1">Level</th>
                <th colspan="2" style="width: 15%;text-align: center;" class="pt-1 pb-1">Actions</th>
              </tr>
              <tr class="tHeadAdd">
                <td style="width:50%;">
                  <input type="text" class="form-control form-control-sm hotel_category"  placeholder=" Enter Room Type Category">
                </td>
                <td style="width: 15%;">
                  <input type="text" class="form-control form-control-sm int hotel_noofrooms"  placeholder=" Enter No. of Rooms">
                </td>
                <td style="width: 20%;">
                  <select class="form-control form-control-sm int room_level" name="room_level">
                    <option value="">Select</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                  </select>
                </td>
                <td style="width: 15%;text-align: center;">
                  <button type="button" class="btn btn-sm btn-info btnAdUpd" onclick="htl.addMore(this);">Add More</button>
                </td>
              </tr>
            </thead>
            <tbody class="tBodyList">
            @if(!empty(@$category))
              @foreach($category as $cat)
                <tr>			
                  <td class="td_cat">{{ $cat->hotel_category }}</td>			
                  <td>{{ $cat->total_rooms }}</td>			
                  <td>{{ $cat->room_level }}</td>    
                  <td style="text-align: center;"> 				
                    <input type="hidden" class="category_info" name="category_info[]" value="{{ $cat->htl_cat_id.'^'.$cat->hotel_category.'^'.$cat->total_rooms.'^'.$cat->room_level }}">				
                    <button type="button" class="btn btn-xs btn-info" onclick="htl.edit(this);">Edit</button>				
                    <button type="button" class="btn btn-xs btn-danger" onclick="htl.delete(this);">Delete</button>			
                  </td>		
                </tr>
              @endforeach
            @endif
            </tbody>
          </table>
        </div>
        <h4 class="bg-primary pl-3 mb-0">FPR Details</h4>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col-sm-6">
              <label for="">Logistic FPR</label>
              <select class="select2 form-control form-control-sm logistic_fpr" name="logistic_fpr" onchange="htl.hideUser(this, 'L');">
                <option value="">Select user</option>
                @foreach($user_list as $fpr)
                  <option value="{{ $fpr->id }}" {{ $logistic_fpr == $fpr->id?'selected':'' }}>{{ $fpr->cpf_no.' - '.$fpr->mobile.' - '.$fpr->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label for="">Hospitality FPR</label>
              <select class="select2 form-control form-control-sm hospitality_fpr" name="hospitality_fpr" onchange="htl.hideUser(this, 'H');">
                <option value="">Select user</option>
                @foreach($user_list as $fpr)
                  <option value="{{ $fpr->id }}"{{ $hospitality_fpr == $fpr->id?'selected':'' }}>{{ $fpr->cpf_no.' - '.$fpr->mobile.' - '.$fpr->name }}</option>
                @endforeach
              </select>
            </div>
            <!--
            <div class="col-sm-6">
              <label for="">Person Name</label>
              <input type="text" class="form-control form-control-sm fpr_name" name="fpr_name" value="{{ old('fpr_name')?@old('fpr_name'):@$hotel->fpr_name }}" placeholder="Enter person name">
            </div>
            <div class="col-sm-6">
              <label for="">Person Contact No.</label>
              <input type="text" class="form-control form-control-sm fpr_mob_no" name="fpr_mob_no" value="{{ old('fpr_mob_no')?@old('fpr_mob_no'):@$hotel->fpr_mob_no }}" placeholder="Enter person contact number">
            </div>
            -->
        </div>
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
<script src="{{ asset('pages/others/hotel.js') }}"></script>
@endsection