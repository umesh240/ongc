@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs';
  $status     = @$feedbackList->status;
  $feedbacks  = @$feedbackList->response->feedback_list;
  //echo '<pre>'; print_r($feedbacks); die;
@endphp
@section('title', $pageNm)
@section('content')
<style type="text/css">
.inner-banner {
  background: url(pages/images/feedback.jpg) no-repeat 0% 50%;
    background-attachment: scroll;
  min-height: 200px;
  background-size: cover;
  background-attachment: fixed;
  position: relative;  
}
#breadcrumb_wrapper {
    width: 100%;
    text-align: center;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.62);
    position: absolute;
    height: 100%;
    top: 0;
    display: flex;
    align-items: center;
}

div#breadcrumb_wrapper h2 {
    text-transform: uppercase;
    font-size: 33px;
    margin-bottom: 10px;
    color: #fff;
}

div#breadcrumb_wrapper h6 {
    color: #fff;
    font-size: 15px;
    font-weight: 400;
}
</style>
<section class="content">
  <div class="">
    <div class="inner-banner demo-2 text-center">
      <div id="breadcrumb_wrapper">
        <div class="container">
          <h2>Feedback</h2>
          <h6>Your feedback is important for us</h6>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="w3l-faq" id="faq">
<div class="container">
  <div class="row d-flex align-items-center justify-content-center">
    @if($status == 200)
    <div class="col-sm-10">
      @foreach($feedbacks as $key => $fdb)
      <div class="text-content">
      <p class="mb-3  text-center">{{ $key+1 }}. {{ $fdb->feedback }}</p>
      <p class="rating_p text-center">
        <input type="hidden" name="feedback_id" class="feedback_id" value="{{ $fdb->fb_id }}">
        <input type="hidden" name="rating" class="rating" value="0">
        <i class="fa fa-regular fa-star text-orange fa-2x"></i>
        <i class="fa fa-regular fa-star text-orange fa-2x"></i>
        <i class="fa fa-regular fa-star text-orange fa-2x"></i>
        <i class="fa fa-regular fa-star text-orange fa-2x"></i>
        <i class="fa fa-regular fa-star text-orange fa-2x"></i>
      </p>
      </div>
      @endforeach
    </div>
    @endif
  </div>
  </div>
</section>
@endsection

@section('javascript')
<script type="text/javascript">
$('.rating_p .fa').on('click', function(){
  var ppp = $(this).closest('.rating_p');
  var rating_prv = ppp.find('.rating').val();
  var rating_index = $(this).index();
  var rate_add = 0.5;
  var new_index = parseInt(rating_index) - parseFloat(rate_add);
  new_index = new_index.toFixed(1);
  ppp.find('.fa').removeClass('fa-regular fa-star fa-star-half-alt ').addClass('fa-regular fa-star');
  for (var i = 0; i < parseInt(rating_index) - 1; i++) {
    ppp.find('.fa:eq('+i+')').removeClass('fa-regular').addClass('fa-star');
  }
  $(this).removeClass('fa-regular fa-star fa-star-half-alt ');
  var icon = 'fa-star-half-alt';
  if(parseFloat(new_index) == parseFloat(rating_prv)){
    var new_index = parseInt(rating_index);
    new_index = new_index.toFixed(1);
    icon = 'fa-star';
  }
  ppp.find('.rating').val(new_index);
  $(this).addClass(icon);
  //console.log(new_index);
});
</script>
@endsection
