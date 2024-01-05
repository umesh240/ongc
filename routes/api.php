<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\ApiUsersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return 1111;
});
*/
Route::middleware(['auth.api'])->group(function () {
    Route::get('/event_details', [ApiUsersController::class, 'eventDetails']); 
    Route::get('/profile', [ApiUsersController::class, 'profile']); 
    Route::post('/check_in_out', [ApiUsersController::class, 'employeeCheckInOut']); 
    Route::post('/flight_book', [ApiUsersController::class, 'flightSave']); 
    Route::get('/hotel_list', [ApiUsersController::class, 'hotelList']); 
    Route::get('/roomtype_list', [ApiUsersController::class, 'roomTypeList']); 
    Route::post('/hotel_change_request', [ApiUsersController::class, 'hotelChangeRequest']); 
    Route::post('/change_password', [ApiUsersController::class, 'changePassword']); 
    Route::post('/user_query', [ApiUsersController::class, 'userQuery']); 
    Route::post('/event_cancel', [ApiUsersController::class, 'eventCancel']); 
    Route::get('/fdb', [ApiUsersController::class, 'feedbackIndex']); 
    //Route::get('/feedback', [ApiUsersController::class, 'feedbackIndex']); 
    Route::post('/feedback', [ApiUsersController::class, 'feedbackSave']); 
});

Route::post('/login_emp', [ApiUsersController::class, 'login_API']);
Route::post('/forgot_password', [ApiUsersController::class, 'forgotPassword']);  
Route::get('/logout', [ApiUsersController::class, 'logOut']);
Route::get('/sos_contact', [ApiUsersController::class, 'sosContactUs']);
Route::get('/quiz', [ApiUsersController::class, 'quizIndex']);
Route::post('/quiz', [ApiUsersController::class, 'quizSave']);
Route::get('/faqs', [ApiUsersController::class, 'faqsList']);
