@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs Master ';
  $answer = $question = '';
  $btn_name = 'Save';
  $cd = 0;

  if(@$faq->faq_id > 0){
    $btn_name = 'Update';
    $cd       = $faq->faq_id;
    $answer   = $faq->answer;
    $question = $faq->question;
  }
@endphp
@section('title', $pageNm)
@section('content')
<style>
.ui-sortable-helper{
  width:100%;
  background-color:#ccc;
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
            <h3 class="card-title">{{ $pageNm }}</h3>
          </div>
          <div class="card-body p-2">
            <form action="{{ route('faqs.save') }}" method="post">
              @csrf
              <input type="hidden" name="cd" value="{{ $cd }}" />
            <div class="row">
              <div class="col-sm-12">
                <label>Question : </label>
                <input type="text" class="form-control form-control-sm question" name="question" value="{{ $question }}" placeholder=" Enter question" required style="text-transform: none;" >
              </div>
              <div class="col-sm-12">
                <label>Answer : </label>
                <textarea rows="5" class="form-control form-control-sm answer" name="answer" value="" placeholder=" Enter answer" required style="text-transform: none;">{{ $answer }}</textarea>
              </div>
              <div class="col-sm-2">
                <label>&nbsp;</label>
                <button type="submit" name="submit" class="btn btn-sm btn-block btn-success"> {{ $btn_name }}</button>
              </div>
            </div>
            </form>
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
    console.log(cnt);

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