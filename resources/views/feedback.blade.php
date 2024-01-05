@extends('layouts.app')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Feedback Master ';
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
            <h3 class="card-title">Add</h3>
          </div>
          <div class="card-body p-2">
            <form action="{{ route('feedback.save') }}" method="post">
              @csrf
              <input type="hidden" name="cd" value="0" />
            <div class="row">
              <div class="col-sm-10">
                <label>Feedback : </label>
                <input type="text" class="form-control form-control-sm feedback" name="feedback" value="" placeholder=" Enter feedback" required style="text-transform: none;" >
              </div>
              <div class="col-sm-2">
                <label>&nbsp;</label>
                <button type="submit" name="submit" class="btn btn-sm btn-block btn-success"> Save</button>
              </div>
            </div>
            </form>
          </div>
        </div>

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">List</h3>
            <button type="button" class="btn btn-xs btn-warning float-right" onclick="sortFeedback(this);" data-link="{{ route('feedback.sort') }}"><i class="fas fa-sort-amount-down"></i> Re-order</button>
          </div>
          <div class="card-body pl-0 pr-0">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr class="bg-dark">
                  <th style="width:7%;">Sr.No.</th>
                  <th style="width:85%;">Question</th>
                  <th style="width:8%;">Action</th>
                </tr>
              </thead>
              <tbody id="sortable">
              @php $cnt = 0; @endphp 
              @foreach ($feedback_list as $key => $feedback) 
              @php $cnt++; @endphp 
              <tr style="width:100%; cursor: move;" class="td_fd_id" data-id="{{ $feedback->fb_id }}">
                <td style="padding-top: 2px; padding-bottom: 2px;width:7%;"><i class="fa fa-arrows-alt-v text-gray"></i> &nbsp;&nbsp;&nbsp;&nbsp;{{ $key+1 }}.</td>
                <td style="padding-top: 2px; padding-bottom: 2px;width:85%;">{{ $feedback->feedback }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;width:8%;">
                  <!--<button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("quiz.ae", ["id" => $feedback->fb_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>-->
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('feedback.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$feedback->fb_id}}');"><i class="fa fa-trash"></i> Trash</button>
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