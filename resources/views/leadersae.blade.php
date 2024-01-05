@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Leaders Master ';
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
    $btn_name = "Save";
    $l_name = $l_post = $l_photo = '';
    if(@$leader->ldr_id > 0){
      $l_name = $leader->l_name;
      $l_post = $leader->l_post;
      $l_photo = @$leader->l_photo;
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
      <form action="{{ route('leaders.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cd" value="{{ @$leader->ldr_id }}" class="cd">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Person Name:</label>
            <input type="text" class="form-control l_name" name="l_name" value="{{ old('l_name')?old('l_name'):@$l_name }}" placeholder=" Leader name" >
          </div>
          <div class="col-sm-12">
            <label>Person Post:</label>
            <input type="text" class="form-control l_post" name="l_post" value="{{ old('l_post')?old('l_post'):@$l_post }}" placeholder=" Person post" >
          </div>
          <div class="col-sm-12">
            <label>Photo:</label>
            <input type="file" class="form-control l_photo" name="l_photo" accept=".jpeg, .jpg, .png" >
          </div>
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
<script type="text/javascript">

</script>
@endsection