@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs Master ';
@endphp
@section('title', $pageNm)
@section('content')
<style>
.ui-sortable-helper{
  width:100%;
  background-color:#ccc;
}
.tooltip-inner {
  text-align: left;
  min-width: 75%;
}
.tooltip {
    min-width: 75% !important;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $pageNm }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <hr class="w-100 mt-0">
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">List</h3>
            <button type="button" class="btn btn-xs btn-warning float-right" onclick="sortFeedback(this);" data-link="{{ route('faqs.sort') }}"><i class="fas fa-sort-amount-down"></i> Re-order</button>
            <button onclick="window.location='{{ route("faqs.ae", ["ae" => "add"]) }}';" class="btn btn-xs btn-success float-right mr-1"><i class="fa fa-plus"></i> Add New</button>
          </div>
          <div class="card-body pl-0 pr-0">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr class="bg-dark">
                  <th style="width:8%;">Sr.No.</th>
                  <th style="width:30%;">Question</th>
                  <th style="">Answer</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody id="sortable">
              @php $cnt = 0; @endphp 
              @foreach ($faqs_list as $key => $faq) 
              @php $cnt++; 
                $question = $question0 = $faq->question;
                $answer   = $answer0   = $faq->answer;

                $len = 40;
                if(strlen($question) > $len){
                  $question = substr($question,0, $len)."...";
                }
                $len = 65;
                if(strlen($answer) > $len){
                  $answer = substr($answer,0, $len)."...";
                }
              @endphp 
              <tr style="width:100%; cursor: move;" class="td_fd_id" data-id="{{ $faq->faq_id }}" data-toggle="tooltip" title="<b>Question :</b><br>{{ $question0 }}<br><br><b>Answer:</b><br>{{ $answer0 }}" data-html="true">
                <td style="padding-top: 2px; padding-bottom: 2px;width:8%;"><i class="fa fa-arrows-alt-v text-gray"></i> &nbsp;&nbsp;&nbsp;&nbsp;{{ $key+1 }}.</td>
                <td style="padding-top: 2px; padding-bottom: 2px; text-align: justify;">{{ $question }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px; text-align: justify;">{{ $answer }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;width:15%;">
                  <button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("faqs.ae", ["id" => $faq->faq_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('faqs.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$faq->faq_id}}');"><i class="fa fa-trash"></i> Trash</button>
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
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
  } );

  function sortFeedback(thiss){
    var idds = [];
    var cnt = 0;
    $('.td_fd_id').each(function(index){
      var id = $(this).attr('data-id');
      idds[index] = id;
      cnt++;
    });
    //var idds = idds.join(',');
    //console.log(cnt);

    var url = $(thiss).attr('data-link');
    if(parseInt(cnt) > 0){
      $.ajax({
        type: "POST",
        url: url,
        data: {idds:idds, _token: "{{ csrf_token() }}"},
        success:function(result){
          //console.log(result);
          result = result.trim();
          result = result.split('||');
          var msg = result[1];
          var mod = result[2];
          show_msgT(mod, msg);
          if(mod == '1'){
            setTimeout(function() {     location.reload();    }, 2000);
          }
        }
      });
    }
  }
  </script>
@endsection