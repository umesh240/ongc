@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Quiz Master ';
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
          <button onclick="window.location='{{ route("quiz") }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-list"></i> List</button>
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <hr class="w-100 mt-0">
  <!-- /.content-header -->
  @php
    $btn_name = "Save";
    $question = $option_1 = $option_2 = $option_3 = $option_4 = $answer = '';
    $event_datefr = $event_dateto = $today = date('Y-m-d H:i');
    if(@$quiz->qz_id > 0){
      $question = @$quiz->question;
      $option_1 = @$quiz->option_1;
      $option_2 = @$quiz->option_2;
      $option_3 = @$quiz->option_3;
      $option_4 = @$quiz->option_4;
      $answer   = @$quiz->answer;
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
      <form action="{{ route('quiz.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cd" value="{{ @$quiz->qz_id }}" class="cd">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <label>Question :</label>
            <textarea cols="3" class="form-control form-control-sm question" name="question" placeholder=" Enter question" required>{{ old('question')?old('question'):@$question }}</textarea>
          </div>
          <div class="col-sm-6">
            <label>Option 1 :</label>
            <textarea cols="2" class="form-control form-control-sm option_1" name="option_1" placeholder=" Enter option 1" required>{{ old('option_1')?old('option_1'):@$option_1 }}</textarea>
          </div>
          <div class="col-sm-6">
            <label>Option 2 :</label>
            <textarea cols="2" class="form-control form-control-sm option_2" name="option_2" placeholder=" Enter option 2" required>{{ old('option_2')?old('option_2'):@$option_2 }}</textarea>
          </div>
          <div class="col-sm-6">
            <label>Option 3 :</label>
            <textarea cols="2" class="form-control form-control-sm option_3" name="option_3" placeholder=" Enter option 3">{{ old('option_3')?old('option_3'):@$option_3 }}</textarea>
          </div>
          <div class="col-sm-6">
            <label>Option 4 :</label>
            <textarea cols="2" class="form-control form-control-sm option_4" name="option_4" placeholder=" Enter option 4">{{ old('option_4')?old('option_4'):@$option_4 }}</textarea>
          </div>
          <div class="col-sm-6">
            <label>Correct answer :</label>
            <select class="form-control form-control-sm answer" name="answer" required>
              <option value="">Select answer</option>
              <option value="1" {{ (old('answer')?old('answer'):@$answer == 1) ?'selected':'' }}>1</option>
              <option value="2" {{ (old('answer')?old('answer'):@$answer == 2) ?'selected':'' }}>2</option>
              <option value="3" {{ (old('answer')?old('answer'):@$answer == 3) ?'selected':'' }}>3</option>
              <option value="4" {{ (old('answer')?old('answer'):@$answer == 4) ?'selected':'' }}>4</option>
            </select>
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