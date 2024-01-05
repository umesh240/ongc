@extends('layouts.app')
@php
  $pageNm = 'Contact us / SOS';
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
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ $pageNm }}</h3>
        </div>
        <form action="{{ route('sos_save') }}" method="post">
        @csrf
        <input type="hidden" name="cd" value="{{ @$sos_contact->cs_id }}" class="cd">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <label>Email-id:</label>
              <input type="email" class="form-control form-control-sm email_id" name="email_id" value="{{ old('email_id')?old('email_id'):@$sos_contact->email_id }}" placeholder=" Enter  E-Mail id">
            </div>
            <div class="col-sm-6">
              <label>Mobile No.:</label>
              <input type="text " class="form-control form-control-sm mobile_no int" name="mobile_no" value="{{ old('mobile_no')?old('mobile_no'):@$sos_contact->phone_no }}" placeholder=" Enter Mobile Number" maxlength="10">
            </div>
            <div class="col-sm-12">
              <label>SOS Information:</label>
              <textarea class="form-control form-control-sm sos_info" name="sos_info" rows="5" placeholder=" Enter SOS info">{{ old('sos_info')?old('sos_info'):@$sos_contact->sos_info }}</textarea>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-success" name="submit"><i class="fa fa-save"></i> Update</button>
        </div>
        <!-- /.card-footer-->
        </form>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
