<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventBookController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CheckInOutSummeryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ContactSosController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\LeadersController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FaqsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = @Auth()->user();
    //print_r($user);
    $userId = @$user->id;
    $userType = @$user->user_type;
    if($userId > 0){
        if($userType == 0 || $userType == 1){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('my.dashboard');
        }
    }
    return view('auth.login');
});

Auth::routes();
Route::middleware(['adminGaurd'])->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        //Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::controller(HomeController::class)->group(function(){
            Route::get('/dashboard', 'index')->name('dashboard');
            //Route::post('/pay/update', 'update')->name('pay.update');
        });
        Route::controller(EventController::class)->group(function(){
            Route::get('/event/{ae}/{id?}', 'show')->name('event.ae')->where('ae', 'add|edit');
            Route::get('/event', 'index')->name('event');
            Route::post('/event/save', 'update')->name('event.save');
            Route::post('/event/delete', 'destroy')->name('event.delete');
        });
        Route::controller(HotelController::class)->group(function(){
            Route::get('/hotel/{ae}/{id?}', 'show')->name('hotel.ae')->where('ae', 'add|edit');
            Route::get('/hotel/{length?}/{search?}', 'index')->name('hotel');
            Route::post('/hotel/save', 'update')->name('hotel.save');
            Route::post('/hotel/delete', 'destroy')->name('hotel.delete');
        });
        Route::controller(UserController::class)->group(function(){
            Route::get('/employee/{ae}/{id?}/{event_id?}', 'show')->name('employee.ae')->where('ae', 'add|edit|hotel|driver|event');
            Route::get('/employee', 'index')->name('employee');
            Route::post('/employee/save', 'update')->name('employee.save');
            Route::post('/employee/delete', 'destroy')->name('employee.delete');
            Route::post('/hotel/assign', 'hotelUpdate')->name('hotel.assign');
        });
        Route::controller(EventBookController::class)->group(function(){
            Route::get('/bookevent/{ae}/{id?}', 'show')->name('bookevent.ae')->where('ae', 'add|edit');
            Route::get('/bookevent', 'index')->name('bookevent');
            Route::post('/bookevent/save', 'update')->name('bookevent.save');
            Route::post('/gethotel', 'getHotelList')->name('gethotel');
            Route::post('/gethtlcategory', 'getHtlCategory')->name('gethtlcategory');
            Route::post('/geteventemp', 'getEventEmployee')->name('geteventemp');
            Route::post('/ckexistemp', 'ckExistEmpEvent')->name('ckExistEmp');
            Route::post('/bookevent/delete', 'destroy')->name('bookevent.delete');
            Route::get('/import_bookevent', 'importEventBooking')->name('import_bookevent');
            Route::get('/get_notification', 'getNotification')->name('get_notification');
        });
        Route::controller(ImportController::class)->group(function(){
            Route::get('/import_bookevent', 'eventBooking')->name('import_bookevent');
            Route::post('/import_bookevent/show', 'importEventBookExcel')->name('import_bookevent.show');
            Route::post('/import_bookevent_save', 'importEventBookSave')->name('import_bookevent.save');
        });
        Route::controller(ReportsController::class)->group(function(){
            Route::get('/hotel_wise', 'indexHW')->name('hotel_wise');
            Route::post('/hotel_wise', 'showHW')->name('hotel_wise_search');
            Route::post('/generate_pdf', 'generatePDF')->name('generate_pdf');
            Route::post('/get_hotel', 'hotelList')->name('get_hotel');
        });
        Route::controller(CheckInOutSummeryController::class)->group(function(){
            Route::get('/check_in_out_summery', 'index')->name('check_inout_summery');
            Route::post('/check_in_out_summery', 'show')->name('check_inout_summery_show');
            Route::get('/room_availability', 'indexRMA')->name('room_availability ');
            Route::post('/room_availability', 'room_available')->name('room_availability_show');
        });
        Route::controller(ContactSosController::class)->group(function(){
            Route::get('/sos', 'index')->name('sos_contact');
            Route::post('/sos_save', 'update')->name('sos_save');
        });
        Route::controller(QuizController::class)->group(function(){
            Route::get('/quiz', 'index')->name('quiz');
            Route::get('/quiz/{ae}/{id?}', 'show')->name('quiz.ae')->where('ae', 'add|edit');
            Route::post('/quiz_save', 'update')->name('quiz.save');
            Route::post('/quiz/delete', 'destroy')->name('quiz.delete');
            Route::get('/quiz/import', 'importQuizIndex')->name('quiz.import');
            Route::post('/quiz/show', 'importQuizShow')->name('quiz.show');
            Route::post('/quiz/save', 'importQuizSave')->name('quiz_import.save');
        });
        Route::controller(LeadersController::class)->group(function(){
            Route::get('/leaders/{ae}/{id?}', 'show')->name('leaders.ae')->where('ae', 'add|edit');
            Route::get('/leaders/{length?}/{search?}', 'index')->name('leaders');
            Route::post('/leaders/save', 'update')->name('leaders.save');
            Route::post('/leaders/delete', 'destroy')->name('leaders.delete');
            Route::post('/abcabc/abcabc', 'edit')->name('abcabc');
            Route::post('leaders/sort', 'leadersSort')->name('leaders.sort');

        });
        Route::controller(SocialLinksController::class)->group(function(){
            Route::get('/socials', 'index')->name('socials');
             Route::post('/socials/update', 'update')->name('socials.update');
            // Route::post('/socials/update', 'update')->name('socials.update');
        });
        Route::controller(AboutController::class)->group(function(){
            Route::get('/about/{about}', 'index')->name('about.links')->where('about', 'ongc|iew|event_location');
            Route::post('/about/update', 'update')->name('about.update');
        });
        Route::controller(FeedbackController::class)->group(function(){
            Route::get('/feedback', 'index')->name('feedback');
            Route::post('feedback', 'store')->name('feedback.save');
            Route::post('feedback/delete', 'destroy')->name('feedback.delete');
            Route::post('feedback/sort', 'feedbackSort')->name('feedback.sort');
        });
        Route::controller(FaqsController::class)->group(function(){
            Route::get('/faqs/{ae}/{id?}', 'show')->name('faqs.ae')->where('ae', 'add|edit');
            Route::get('/faqs', 'index')->name('faqs');
            Route::post('/faqs/save', 'update')->name('faqs.save');
            Route::post('/faqs/delete', 'destroy')->name('faqs.delete');
            Route::post('faqs/sort', 'faqsSort')->name('faqs.sort');
        });

    });
});

Route::get('/logout', function () {
    return view('auth.login');
});
Route::get('/logout', [UserController::class, 'logout'])->name('logout'); 

Route::middleware(['employeeGaurd'])->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::controller(UserDashboardController::class)->group(function(){
            Route::get('/my.dashboard', 'index')->name('my.dashboard');
            Route::get('/my.event', 'index2')->name('my.event');
            Route::post('/check_in_out', 'empCheckInOut')->name('check_in_out');
            Route::post('/flight_book_update', 'flightSave')->name('flight_book_update');
            Route::post('/getroomtype', 'getHtlCategory')->name('getroomtype');
            Route::post('/change_hotel_req', 'changeHtlReq')->name('change_hotel_req');
            Route::post('/change_password', 'changePassword')->name('change_password');
            Route::post('/user_query', 'userQuery')->name('user_query');
            Route::post('/event_cancel', 'eventCancel')->name('event_cancel');
            Route::get('/menus', 'menuPage')->name('menu.page');


            Route::get('/my.{page}', 'pageIndex')->name('my.page')->where('page','participation|quiz|faq|feedback|flight|helpdesk|about|change_password|day_wise|date_wise');
            /*
            Route::get('/my.faq', 'faqIndex')->name('my.faq');
            Route::get('/my.feedback', 'feedbackIndex')->name('my.feedback');
            Route::get('/my.flight', 'flightIndex')->name('my.flight');
            Route::get('/my.quiz', 'index')->name('my.dashboard');
            Route::get('/my.change-password', 'index')->name('my.dashboard');
            */
        });
        
    });
});

Route::get('/testEmail', [EmailController::class, 'testEmail'])->name('testEmail'); 
Route::get('/var_dump', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        echo 'cleared';
        $routes = Route::getRoutes();
        // Output the routes
        foreach ($routes as $route) {
            echo "<br>".$route->getName() . ' - ' . $route->uri() . PHP_EOL;
        }
});
// php artisan make:middleware adminGaurd
// php artisan make:model Company -mcr

