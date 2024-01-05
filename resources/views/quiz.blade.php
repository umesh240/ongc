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
            <h1 class="m-0">{{ $pageNm }}<font class="activePg">List</font></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <button onclick="window.location='{{ route("quiz.ae", ["ae" => "add"]) }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Add New</button>
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
             {{ $quiz_list->links('vendor.pagination.search', ['routename' => "quiz", 'list_length' => $list_length, 'list_search' => $list_search]) }}
          </div>
          <div class="col-lg-12">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr>
                  <th>Question</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody>
              @php $cnt = 0; @endphp 
              @foreach ($quiz_list as $quiz) 
              @php $cnt++; @endphp 
              <tr style="">
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $quiz->question; }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                  <button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("quiz.ae", ["id" => $quiz->qz_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('quiz.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$quiz->qz_id}}');"><i class="fa fa-trash"></i> Trash</button>
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
            {{ $quiz_list->links('vendor.pagination.bootstrap-4') }}
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