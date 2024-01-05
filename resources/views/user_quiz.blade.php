@extends('layouts.app_user_new')
@php
  $curRouteNm = Route::currentRouteName();
  $pageNm = 'Quiz';
@endphp
@section('title', $pageNm)
@section('content')


<section class="banner-inner">
<div class="bg-img"> </div>
	<div class="container">
		<h2><i>"Test your knowledge with our engaging quizzes! Challenge yourself<br> and discover something new every day. Join the fun now!"</i></h2>
	</div>
 
</section>
<section class="quiz">
  <div class="conatiner">
    <div class="row">
      <div class="col-sm-1 col-0 up-image"></div>
      <div class="col-sm-10">
        <table>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm-12 col-12 p-0 pl-2">Q1. What is the first step in the event planning process?</div>
                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'A',1)">A. Budgeting</div>
                 
                <div class="p-2 bg-white options" onclick="checkAnswer(this, 'B',1)">B. Venue selection</div>

                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'C',1)">C. Setting goals and objectives</div>
      
                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'D',1)">D. Creating a guest list</div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row pt-3">
                <div class="col-sm-12 col-12 p-0 pl-2">Q2. When choosing a venue for a corporate event, what factor is most important?</div>
                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'A',2)">A. Proximity to public transportation</div>
                 
                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'B',2)">B. Available parking</div>

                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'C',2)">C. SCapacity</div>
      
                <div class=" p-2 bg-white options" onclick="checkAnswer(this, 'D',2)">D. Aesthetic appeal</div>
              </div>
            </td>
          </tr>
          
        </table>
      </div>
      <div class="col-sm-1  col-0 down-image"></div>
      
      <div></div>
      <div></div>
    </div>
  </div>
</section>

@endsection
 
@section('javascript')

  <script>
        function checkAnswer(element, selectedOption, questionNumber) {
        
            const options = element.parentNode.getElementsByClassName('options');
            for (const option of options) {
                option.classList.remove('correct', 'incorrect');
            }

      
            const correctOptions = {
                1: 'A',
                2: 'C'
            };

         
            const correctOption = correctOptions[questionNumber];

        
            if (selectedOption === correctOption) {
                element.classList.add('correct');
            } else {
                element.classList.add('incorrect');
            }
        }
    </script>

@endsection
