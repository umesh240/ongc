@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Flight';
@endphp
@section('title', $pageNm)
@section('content')

<section class="flights">
<div class="flight-bg"></div>
 <div class="container">
 <div class="arrival-departure">
        <div class="row pt-5">
        <p>Kindly provide the necessary information for reserving the vehicle.</p>
            <div class="col-md-8 offset-md-2 mt-5 fancy-forms">
                 <!-- <div class="cardbox"> -->
                    <ul class="nav nav-tabs  mt-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="arrival" data-toggle="tab" href="#login_form" role="tab" aria-controls="login" aria-selected="true">Arrival</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="departure" data-toggle="tab" href="#signup_form" role="tab" aria-controls="signup" aria-selected="false">Departure</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="login_form" role="tabpanel" aria-labelledby="login">
                            <div class="fancyformcontainer">

                                <div class="arrival pt-4">
                                    <form class="frmFlightBook" action="https://ongc.goplasticfree.in/flight_book_update" method="post">
                                      <input type="hidden" name="_token" value="8aIpwLiTRLqMrFPLSrPkYa7fqwfpbNMKdzTFs1mS" autocomplete="off">										<input type="hidden" name="flight_book_type" class="flight_book_type" value="arr">
                                      <input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="3">
                                 
                                      <div class="form-group flight-arrival">
                                       
                                      <i class="fas fa-user"></i> <input type="text" class="form-control flight_name" name="flight_name" placeholder="Enter Your Name">
                                      </div>
                                      <div class="form-group flight-arrival">
                                        
                                        <i class="fas fa-fighter-jet"></i><input type="text" class="form-control flight_number" name="flight_number" required="" placeholder="Enter Flight Number">
                                      </div>
                            
                                      <div class="form-group flight-arrival">
                                      
                                       <i class="far fa-calendar-alt"></i> <input type="text" class="form-control date_time" name="date_time" required=""  placeholder="dd/mm/yy">
                                      </div>
                            
                                      <div class="form-group flight-arrival">
                                        
                                       <i class="fas fa-map-marker-alt"></i> <input type="text" class="form-control location" name="location" placeholder="Enter Your Location">
                                      </div>
                            
                                      <div id="button">
                                        <button type="button" class="checkinbtn" onclick="ud.saveflight(this)" name="submit">Submit</button>
                                      </div>
                                    </form>
                                  </div>
                             </div>
                           </div>
                        <div class="tab-pane fade" id="signup_form" role="tabpanel" aria-labelledby="signup">
                            <div class="fancyformcontainer">
                         
                                <div class="departure pt-4">
                                    <form class="frmFlightBook" action="https://ongc.goplasticfree.in/flight_book_update" method="post">
                                      <input type="hidden" name="_token" value="8aIpwLiTRLqMrFPLSrPkYa7fqwfpbNMKdzTFs1mS" autocomplete="off">										<input type="hidden" name="flight_book_type" class="flight_book_type" value="dpt">
                                      <input type="hidden" class="emp_ev_book_id" name="emp_ev_book_id" value="3">
                                      <div class="form-group flight-arrival">
                                       
                                      <i class="fas fa-user"></i>  <input type="text" class="form-control flight_name" name="flight_name" placeholder="Enter name">
                                      </div>
                                      <div class="form-group flight-arrival">
                                       
                                      <i class="fas fa-fighter-jet"></i>  <input type="text" class="form-control flight_number" name="flight_number" required="" placeholder="Enter number">
                                      </div>
                            
                                      <div class="form-group flight-arrival">
                                       
                                       <i class="far fa-calendar-alt"></i> <input type="text" class="form-control date_time" name="date_time" required="" placeholder="dd/mm/yy">
                                      </div>
                            
                                      <div class="form-group flight-arrival">
                                     
                                       <i class="fas fa-map-marker-alt"></i> <input type="text" class="form-control location" name="location" placeholder="Enter Location">
                                      </div>
                                      <div id="button">
                                        <button type="button" class="checkinbtn" onclick="ud.saveflight(this)" name="submit">Submit</button>
                                      </div>
                                    </form>
                                  </div>
                             </div>
                        </div>
                    </div>
             <!-- 	</div> -->
            </div>
            </div>
        </div>
    </div>
    </scetion>
    
    
    
@endsection
