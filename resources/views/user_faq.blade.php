@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'FAQs';
  //echo '<pre>'; print_r($faqsList);
  $status   = @$faqsList->status;
  $falList  = @$faqsList->response;
@endphp
@section('title', $pageNm)
@section('content')
<style type="text/css">
.inner-banner {
  background: url(pages/images/faq.jpg) no-repeat 0% 100%;
    background-attachment: scroll;
    background-size: auto;
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
.w3l-faq ul {
  list-style: none;
  padding: 0;
}
.w3l-faq ul li p{
  color: #515050 !important;
}
.w3l-faq ul li {
  position: relative;
  padding: 1px 10px 1px 15px;
  margin: 0 0 10px 0;
  border-left: 2px solid #F07E29;
  background: rgba(248, 249, 250, 0.4); }

.w3l-faq ul li:nth-of-type(1) {
  -webkit-animation-delay: 0.5s;
  animation-delay: 0.5s; }

.w3l-faq ul li:nth-of-type(2) {
  -webkit-animation-delay: 0.75s;
  animation-delay: 0.75s; }

.w3l-faq ul li:nth-of-type(3) {
  -webkit-animation-delay: 1s;
  animation-delay: 1s; }

.w3l-faq ul li:nth-of-type(4) {
  -webkit-animation-delay: 1.25s;
  animation-delay: 1.25s; }

.w3l-faq ul li:nth-of-type(5) {
  -webkit-animation-delay: 1.50s;
  animation-delay: 1.50s; }

.w3l-faq ul li:nth-of-type(6) {
  -webkit-animation-delay: 1.75s;
  animation-delay: 1.75s; 
}

.w3l-faq ul li i {
  position: absolute;
  transform: translate(-6px, 0);
  margin-top: 16px;
  right: 25px;
  top: 7px; 
}

.w3l-faq ul li i:before,
.w3l-faq ul li i:after {
  content: "";
  position: absolute;
  background-color: #090909;
  width: 3px;
  height: 9px; 
}

.w3l-faq ul li i:before {
  transform: translate(-2px, 0) rotate(45deg); 
}

.w3l-faq ul li i:after {
  transform: translate(2px, 0) rotate(-45deg); 
}

.w3l-faq ul li input[type=checkbox] {
  position: absolute;
  cursor: pointer;
  width: 100%;
  height: 100%;
  z-index: 1;
  opacity: 0;
  top: 0;
  left: 0;
  -webkit-appearance: none; 
}

.w3l-faq ul li input[type=checkbox]:checked ~ p {
  margin-top: 0;
  max-height: 0;
  opacity: 0;
  transform: translate(0, 50%); }

.w3l-faq ul li input[type=checkbox]:checked ~ i:before {
  transform: translate(2px, 0) rotate(45deg); }

.w3l-faq ul li input[type=checkbox]:checked ~ i:after {
  transform: translate(-2px, 0) rotate(-45deg); }

</style>
<section class="content">
  <div class="">
    <div class="inner-banner demo-2 text-center">
      <div id="breadcrumb_wrapper">
        <div class="container">
          <h2>FAQ's</h2>
          <h6>Frequently Asked Questions</h6>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="w3l-faq" id="faq">
  <div class="faq-page">
    <ul>
      @if($status == 200)
      @foreach($falList as $key => $faq)
      <li>
        <input type="checkbox" checked="" value="{{ $faq->faq_id }}">
        <i></i>
        <h3>{{ $faq->question }}</h3>
        <p class="mb-0">{{ $faq->answer }}</p>
      </li>
      @endforeach
      @endif
    </ul>
  </div>
</section>
@endsection
