@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Import Quiz';

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
            <a href="{{ asset('/storage/app/quiz_fromat.csv') }}"  class="btn btn-success btn-sm float-right" download>Export Format</a>
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
          <h3 class="card-title">{{ $pageNm }}</h3>
        </div>
        @if(@$showlist == 0 || @$showlist == '')
        <form action="{{ route('quiz.show') }}" method="post" class="frmQuiz" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-sm-8">
                <label for="">Excel File</label>
                <div class="custom-file">
                  <input type="file" name="excel_file" class="custom-file-input custom-file-input excel_file" id="customFile">
                  <label class="custom-file-label" for="customFile" style="margin-top: 0 !important;">Choose file</label>
                </div>
              </div>
              <div class="col-sm-2">
                <label for="" class="w-100">&nbsp;</label>
                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
              </div>
            </div>
          </div>
        </form>
        @endif
        <!-- /.1st card-footer-->
        @if(@$showlist == 1)
        <!-- 2nd card-footer start -->
        <form action="{{ route('quiz_import.save') }}" method="post" class="frmQuizSave">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-sm-2">
                <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Submit</button>
                <button type="button" name="reset" class="btn btn-sm btn-primary" onclick="linkClick(this);" data-link="{{ route('quiz.import') }}"><i class="fa fa-reset"></i> Refresh</button>
              </div>
              <hr class="w-100 m-2">
              <div class="col-sm-12">
                <table class="table table-bordered" width="100%">
                  <tbody>
                  @php 
                  $rowStatusTitle = array(0 => 'New Booking Entry', 1 => 'Booking Update Request', 2 => 'Email Same But CPF No. Different.');
                  $rowStatusTxt = array(0 => 'New', 1 => 'Update', 2 => 'Mismatch');
                  $rowStatusClr = array(0 => 'success', 1 => 'primary', 2 => 'danger');
                  @endphp 
                  @foreach($excelRows as $key => $row)
                  <tr class="trrEB">
                    <td width="100%" class="pt-0 pb-0">
                      <b>Q {{ ($key + 1) }}. {{ $row[1] }}</b><br>
                      <span for="" class="w-50 float-left"><b>a.</b> {{ $row[2] }}</span>
                      <span for="" class="w-50 float-right"><b>b.</b> {{ $row[3] }}</span>
                      <span for="" class="w-50 float-left"><b>c.</b> {{ $row[4] }}</span>
                      <span for="" class="w-50 float-right"><b>d.</b> {{ $row[5] }}</span>
                      <br><font class="text-success"><b>Answer : </b>  {{ $row[6] }}</font>
                          @if($row[7] == 1)
                          <font class="text-danger ml-5"><b>This question is already exist, So not update. </b></font>
                          @else
                          <input type="hidden" class="quizAdd" name="quizAdd" value="{{ $row[1].'##'.$row[2].'##'.$row[3].'##'.$row[4].'##'.$row[5].'##'.$row[6] }}">
                          @endif
                          <font class="float-right tdStatus"></font>
                    </td>
                  </tr>
                  @endforeach
                  <tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Submit</button>
            <button type="button" name="reset" class="btn btn-sm btn-primary" onclick="linkClick(this);" data-link="{{ route('quiz.import') }}"><i class="fa fa-reset"></i> Refresh</button>
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