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
            <h1 class="m-0">{{ $pageNm }}<font class="activePg">List</font></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <button onclick="window.location='{{ route("leaders.ae", ["ae" => "add"]) }}';" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Add New</button>
            <button type="button" class="btn btn-sm btn-warning float-right mr-2" onclick="sortFeedback(this);" data-link="{{ route('leaders.sort') }}"><i class="fas fa-sort-amount-down"></i> Re-order</button>
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
          {{--
          <div class="col-lg-12">
             {{ $leaders_list->links('vendor.pagination.search', ['routename' => "leaders", 'list_length' => $list_length, 'list_search' => $list_search]) }}
          </div>--}}
          <div class="col-lg-12">
            <table class="table table-bordered" width="100%" style="min-width: 100%;">
              <thead>
                <tr>
                  <th style="width:8%;">Sr.No.</th>
                  <th>Name</th>
                  <th>Post</th>
                  <th style="text-align: center; width: 10%;">Photo</th>
                  <th style="width:15%;">Action</th>
                </tr>
              </thead>
              <tbody id="sortable">
              @php $cnt = 0; @endphp 
              @foreach ($leaders_list as $key => $list) 
              @php $cnt++; @endphp 
              <tr style="width:100%; cursor: move;" class="td_ldr_id"  data-id="{{ $list->ldr_id }}">
                <td style="padding-top: 2px; padding-bottom: 2px;width:8%;"><i class="fa fa-arrows-alt-v text-gray"></i> &nbsp;&nbsp;&nbsp;&nbsp;{{ $key+1 }}.</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $list->l_name }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px;">{{ $list->l_post }}</td>
                <td style="padding-top: 2px; padding-bottom: 2px; text-align: center; width: 10%;">
                  <img src="{{ asset('/storage/app/leaders_photo/'.$list->l_photo) }}" style="width: 50px; height: 50px;">
                </td>
                <td style="padding-top: 2px; padding-bottom: 2px;">
                  <button type="button" class="btn btn-xs btn-info" title="View / Edit" onclick="window.location='{{ route("leaders.ae", ["id" => $list->ldr_id, "ae" => "edit"]) }}';"><i class="fa fa-eye"></i> View/ Edit</button>
                  <button type="button" class="btn btn-xs btn-danger" data-link="{{ route('leaders.delete') }}" title="Delete" onclick="recordsDelete(this, '{{$list->ldr_id}}');"><i class="fa fa-trash"></i> Trash</button>
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
          {{--
          <div class="col-lg-12">
            {{ $leaders_list->links('vendor.pagination.bootstrap-4') }}
          </div>--}}
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
  });

   function sortFeedback(thiss){
    var idds = [];
    var cnt = 0;
    $('.td_ldr_id').each(function(index){
      var id = $(this).attr('data-id');
      idds[index] = id;
      cnt++;
    });
    var idds = idds.join(',');
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