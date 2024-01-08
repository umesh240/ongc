@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Menu';
@endphp
@section('title', $pageNm)
@section('content')

<section class="menu">
   <div class="container">
      <div class="menu-select">
         <div class="col-md-8">
            <div class="row">
               
                  <div class="col-md-4">
                     <div class="menu-icon">
                        <i class="far fa-calendar-minus"></i>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="menu-content">
                        <h4>Day Wise Event</h4>
                        <p>Fuel Your Week with Virtual Connections, Learning, and Growth - Join Us Daily for Inspiring
                           Events.</p>
                        <div class="stage pt-2 mb-4">
                           <a href="#">Read More</a>
                        </div>
                     </div>
                  </div>
               <hr style="width:100%">
               
                  <div class="col-md-4 pt-2">
                     <div class="menu-icon">
                        <i class="fas fa-user-edit"></i>
                     </div>
                  </div>
                  <div class="col-md-8 pt-2">
                     <div class="menu-content">
                        <h4>Quiz</h4>
                        <p>Challenge Your Knowledge: Dive into our Daily Quiz and Unleash Your Intellectual Prowess.</p>
                        <div class="stage pt-2 mb-4">
                           <a href="#">Read More</a>
                        </div>
                     </div>
                  </div>
               <hr style="width:100%">
               
               <div class="col-md-4 pt-2">
                  <div class="menu-icon">
                     <i class="far fa-comment-dots"></i>
                  </div>
               </div>
               <div class="col-md-8 pt-2">
                  <div class="menu-content">
                     <h4>Feedback</h4>
                     <p>Fuel Your Week with Virtual Connections, Learning, and Growth - Join Us Daily for Inspiring
                        Events.</p>
                     <div class="stage pt-2">
                        <a href="#">Read More</a>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
   </scetion>  
@endsection
