@extends('layouts.app')
@php
  $pageNm = 'Social Link';
  $link_cds = [];
  $link_cdsAll = '';
@endphp
@section('title', $pageNm)
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $pageNm }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{ $pageNm }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title">{{ $pageNm }}</h3>
        </div>
        <form action="{{ route('socials.update') }}" method="post">
        @csrf
        <div class="card-body">
          @foreach($social_links as $links)
          @php
          $link_cds[] = $links->soc_id;
          $link_cdsAll = implode(',', $link_cds);
          $sc_show = $links->sc_show == 1?'checked':'';
          @endphp
          <div class="row mb-1 pb-1" style="border-bottom: 1px solid #ccc;">
            <input type="hidden" name="sid_{{ $links->soc_id }}" value="{{ $links->soc_id }}">
            <div class="col-sm-2">
              <span class="text-bold">{{ $links->sc_name }}</span>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" name="links_{{ $links->soc_id }}" value="{{ $links->sc_link }}" placeholder=" Social Link" style="text-transform: lowercase;">
            </div>
            <div class="col-sm-2">
              <input type="checkbox" data-bootstrap-switch data-off-text="Hide" data-on-text="Show" data-off-color="danger" data-on-color="success" name="show_{{ $links->soc_id }}" {{ $sc_show }} value="1">
            </div>
          </div>
          @endforeach
          <input type="hidden" name="link_cdsAll" value="{{ $link_cdsAll }}">
        </div>
        <div class="card-footer">
          <button type="submit" name="submit" value="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
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
