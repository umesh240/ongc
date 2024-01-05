@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs';
@endphp
@section('title', $pageNm)
@section('content')


<section class="password-banner">
  <div class="pswd-bg"></div>
   <div class="container">
     <h2><i>
"Enhance your security: Change your password regularly to safeguard your account and ensure continued protection."</i></h2>  
   </div>
</section>

<section class="change-password">
<div class="content-colour">
<div class="container">
<div class="row d-flex align-items-center justify-content-center">
<div class="col-md-8">
<div class="form" id="hotelName">

  <form class="form-password" action="https://ongc.goplasticfree.in/change_password" method="post">
    <input type="hidden" name="_token" value="8aIpwLiTRLqMrFPLSrPkYa7fqwfpbNMKdzTFs1mS" autocomplete="off">						
    <div class="form-group">
      <label for="exampleInputCRF" class="label-pswd mb-2">Old Password</label>
      <input type="password" class="form-control" name="old_password" value="" placeholder="your old password"><i class="fas fa-lock"></i>
       <div class="eye-icon">
         <i class="fas fa-eye"></i>
       </div>
    </div>

    <div class="form-group">
      <label for="exampleInputName" class="label-pswd mb-2">New Password</label>
      <input type="password" class="form-control" name="new_password" value="" placeholder="your new password"><i class="fas fa-lock"></i>
        <div class="eye-icon">
         <i class="fas fa-eye"></i>
       </div>
    </div>

    <div class="form-group ">
      <label for="exampleInputnumber" class="label-pswd mb-2">Confirm Password</label>
       <input type="password" class="form-control" name="confirm_password" value="" placeholder="confirm password"> <i class="fas fa-lock"></i>
         <div class="eye-icon">
         <i class="fas fa-eye"></i>
       </div>
    </div>
    <div id="button">
      <button type="button" class="checkinbtn" id="submitRequest" name="button" onclick="ud.password(this)">Confirm Password</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
