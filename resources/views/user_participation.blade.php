@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Participation';
@endphp
@section('title', $pageNm)
@section('content')

<section class="participate-inner">
<div class="participate-bg"></div>
<div class="container">
<p><i>"Tell us why. Withdrawal or cancellation? Share your reason. We're here to help."</i></p>
</div>
</section>

<section class="participation">
<div class="container">
<div class="row d-flex align-items-center justify-content-center pt-5">
<div class="col-md-10">
<h4>Select Reason for Withdrawal/ Cancellation</h4>
<form class="frm_event_cancel" action="https://ongc.goplasticfree.in/event_cancel" method="post">
  <input type="hidden" name="_token" value="8aIpwLiTRLqMrFPLSrPkYa7fqwfpbNMKdzTFs1mS" autocomplete="off">						
  <input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="3">
<div class="form-group  pt-5">
    <p>1. What is the primary reason for your withdrawal from the event?</p>
 
<div class="custom-select" id="custom-select"  style="height: 55px;">
    <div class=" select-styled reason_type" style=" line-height: 1.5;">Select an option</div>
    <ul>
        <li class="option1">Participation Withdrawn/ Cancellation</li>
        <li class="option2">Postpone Coming Plan</li>
        <li class="option3">Delay/Change Flight</li>
        <li class="option4">Others</li>
    </ul>
</div>

  <div class="form-group part-text pt-4">
    <p>2. Please provide any additional comments:-</p>
    <textarea class="form-control cancel_reason" name="cancel_reason" placeholder=" Enter Cancellation Reason"></textarea>
  </div>
  <div>
  <button type="button" class="checkinbtn btn-participation" id="submitRequest" name="button" onclick="ud.cancelReason(this)">Submit </button>
   </div>
</form>
</div>
</div>
</div>
</section>
<script>
    document.addEventListener('click', function (event) {
        var customSelect = document.getElementById('custom-select');
        var textarea = document.querySelector('.part-text');

       
        if (!customSelect.contains(event.target)) {
            customSelect.classList.remove('open');
            textarea.style.marginTop = '0';
        }
    });

    document.getElementById('custom-select').addEventListener('click', function () {
   
        this.classList.toggle('open');

   
        var textarea = document.querySelector('.part-text');
        var dropdownHeight = document.querySelector('.custom-select ul').offsetHeight;

        if (this.classList.contains('open')) {
            textarea.style.marginTop = dropdownHeight + 'px';
        } else {
            textarea.style.marginTop = '0';
        }
    });


    document.querySelectorAll('.custom-select ul li').forEach(function (option) {
        option.addEventListener('click', function () {
        
            document.querySelector('.select-styled').innerText = this.innerText;
           
            document.getElementById('custom-select').classList.remove('open');

            document.querySelector('.cancel_reason').style.marginTop = '0';
        });
    });
    
    
</script>
@endsection
