@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs';
@endphp
@section('title', $pageNm)
@section('content')
@php 
  // echo '<pre>'; print_r($sos_contact);
  $sos_info = $phone = $email = '';

  $status_sos = @$sos_contact->status;
  if($status_sos === 200){
    $sos_info         = @$sos_contact->response->sos_info;
    $phone            = @$sos_contact->response->phone_no;
    $email            = @$sos_contact->response->email_id;

    $emp_hotel_cd     = @$sos_contact->response->emp_hotel_cd;
    $fpr_name         = @$sos_contact->response->fpr_name;
    $fpr_mob_no       = @$sos_contact->response->fpr_mob_no;
    $hosp_fpr_name    = @$sos_contact->response->hosp_fpr_name;
    $hosp_fpr_mob_no  = @$sos_contact->response->hosp_fpr_mob_no;
  }
  @endphp

<section class="desk-banner">
 <div class="desk-inner"></div>
  <div class="container">
  <h2><i>
"Need assistance? Our Help Desk is here for you! <br> Get prompt support and answers to your queries. Reach out today!"</i></h2>
  </div>
</section>
<section class="help-desk">
<div class="container">
<div class="content-box">
<div class="row">
          <div class="col-sm-12 text-justify">
            <p>{{ $sos_info }}</p>
          </div>
          
          <div class="col-sm-6">
            @if(!empty(trim($phone)))
              <p><b>Email-id : </b> {{ $email }}</p>
            @endif
          </div>
          <div class="col-sm-6">
            @if(!empty(trim($email)))
              <p><b>Contact No. : </b>{{ $phone }}</p>
            @endif
          </div>
        </div>


<div class="container">
        <div class="row pt-4">
          @if($emp_hotel_cd > 0)
          <div class="heading-bg">
          <h4 class="mb-0 w-100 p-2 pl-4 "><b>FPR Details</b></h4>
          @if(!empty($fpr_name))
          </div>
          <div class="col-sm-12 pt-4">
              <p><b> Logistic : </b><b> Name- </b>{{ $fpr_name }}, <b> Contact No. - </b>{{ $fpr_mob_no }}</p>
          </div>
          @endif
          @if(!empty($hosp_fpr_name))
          <div class="col-sm-12">
              <p><b> Hospitality : </b><b> Name- </b>{{ $hosp_fpr_name }}, <b> Contact No. - </b>{{ $hosp_fpr_mob_no }}</p>
          </div>
          @endif
          @endif
        </div>
</div>

<div class="container">
<div class="row pt-4">
 <div class="heading-bg">
            <h4 class="mb-0 w-100 p-2 pl-4 "><b>Query</b></h4>
            </div>
      <div class="modal-footer text-left pt-3">
        <form class="sos-query w-100" action="{{ route('user_query') }}" method="post">
          @csrf
          <input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="{{ $emp_ev_book_id }}">
          <div class="row w-100">
            <div class="col-md-12 mt-2 p-0">
              <textarea rows="2" class="form-control query_text" name="query" placeholder=" Enter your query here"></textarea>
            </div>
            <div class="col-md-12 mt-3">
              <button type="button" name="submit_query" class="btnCkInOut helpDesk-btn" onclick="ud.query(this)"> Submit</button>
            </div>
          </div>
        </form>
      </div>
</div>
</div>
</div>
</div>
</section>
@endsection
