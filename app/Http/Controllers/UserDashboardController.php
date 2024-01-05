<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

use App\Http\Controllers\API\ApiUsersController;
use App\Http\Controllers\EventController;

class UserDashboardController extends Controller
{
    
    public function index()
    {
        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;

        $emp_event_cd = $user->cur_event;
        $event = new EventController();
        $wheather = $event->eventWheather($emp_event_cd);

        $api = new ApiUsersController();
        $api_data = new Request([
            'id' => $userId,
            'auth' => $token
        ]);
        $resp = $api->eventDetails($api_data); 

        $responseData = $resp->getData();
        //echo '<pre>'; print_r($responseData); die;
        $status = $responseData->status;
        $userData = @$responseData->response;

        $event_cd = $emp_ev_book_id = 0;
        if($status == 200 && !empty($userData)){
            $emp_ev_book_id = $userData->emp_ev_book_id;
            $event_cd = $userData->emp_event_cd;
            $hotel_list = DB::table('hotels')->where('evv_id', $event_cd)->where('actv_hotel', 1)->select("htl_id", "hotel_name", "hotel_address", "evv_id")->get();
            $data['hotel_list'] = $hotel_list;
            $req_chng_hotel_cd      = $userData->req_chng_hotel_cd;
            $req_chng_hotel_cat_cd  = $userData->req_chng_hotel_cat_cd;
            $req_chng_status        = $userData->req_chng_status;
            if($req_chng_status == '1'){
                $chngHtlInfo = DB::table('event_books_emp')->where('event_books_emp.emp_ev_book_id', $emp_ev_book_id)
                                ->leftJoin('hotels', 'event_books_emp.req_chng_hotel_cd', '=', 'hotels.htl_id')
                                ->leftJoin('hotels_category', 'event_books_emp.req_chng_hotel_cat_cd', '=', 'hotels_category.htl_cat_id')
                                ->select("hotels.htl_id", "hotels.hotel_name", "hotels_category.htl_cat_id", "hotels_category.hotel_category", "hotels.hotel_address", "event_books_emp.req_chng_instraction", "event_books_emp.req_chng_status")->first();
                $data['changHtlInfo'] = $chngHtlInfo;
            }
        }else{
            $userData = $responseData->response;
            if($status == 500){
                $userData = $responseData->message;
            }
            if($status == 200 && empty($userData)){
                $status = 400;
            }
        }
        session(['emp_ev_book_id' => $emp_ev_book_id, 'event_cd' => $event_cd, 'userId' => $userId, 'token' => $token]);

        $data['status'] = $status;
        $data['userData'] = $userData;
        $sosApiData = new Request([
            'emp_ev_book_id' => $emp_ev_book_id
        ]);
        $sos_contact = $api->sosContactUs($sosApiData); 
        $sosData = $sos_contact->getData();
        $data['sos_contact'] = $sosData;
        //echo '<pre>'; print_r($data);  die;
        return view('user_dashboard', $data);
    }

    public function index2()
    {
        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;

        $emp_event_cd = $user->cur_event;
        $event = new EventController();
        $wheather = $event->eventWheather($emp_event_cd);

        $api = new ApiUsersController();
        $api_data = new Request([
            'id' => $userId,
            'auth' => $token
        ]);
        $resp = $api->eventDetails($api_data); 

        $responseData = $resp->getData();
        $status = $responseData->status;
        $userData = @$responseData->response;

        $emp_ev_book_id = 0;
        if($status == 200 && !empty($userData)){
            $emp_ev_book_id = $responseData->response->emp_ev_book_id;
            $event_cd = $responseData->response->emp_event_cd;
            $hotel_list = DB::table('hotels')->where('evv_id', $event_cd)->where('actv_hotel', 1)->select("htl_id", "hotel_name", "hotel_address", "evv_id")->get();
            $data['hotel_list'] = $hotel_list;
            $req_chng_hotel_cd = $responseData->response->req_chng_hotel_cd;
            $req_chng_hotel_cat_cd = $responseData->response->req_chng_hotel_cat_cd;
            $req_chng_status = $responseData->response->req_chng_status;
            if($req_chng_status == '1'){
                $chngHtlInfo = DB::table('event_books_emp')->where('event_books_emp.emp_ev_book_id', $emp_ev_book_id)
                                ->leftJoin('hotels', 'event_books_emp.req_chng_hotel_cd', '=', 'hotels.htl_id')
                                ->leftJoin('hotels_category', 'event_books_emp.req_chng_hotel_cat_cd', '=', 'hotels_category.htl_cat_id')
                                ->select("hotels.htl_id", "hotels.hotel_name", "hotels_category.htl_cat_id", "hotels_category.hotel_category", "hotels.hotel_address", "event_books_emp.req_chng_instraction", "event_books_emp.req_chng_status")->first();
                $data['changHtlInfo'] = $chngHtlInfo;
            }
        }else{
            $userData = $responseData->response;
            if($status == 500){
                $userData = $responseData->message;
            }
            if($status == 200 && empty($userData)){
                $status = 400;
            }
        }
        $data['status'] = $status;
        $data['userData'] = $userData;
        $sosApiData = new Request([
            'emp_ev_book_id' => $emp_ev_book_id
        ]);
        $sos_contact = $api->sosContactUs($sosApiData); 
        $sosData = $sos_contact->getData();
        $data['sos_contact'] = $sosData;
        //echo '<pre>'; print_r($data);  die;
        return view('user_dashb_event', $data);
    }
    public function empCheckInOut(Request $request)
    {
        //print_r($request->all());
        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;
        $api = new ApiUsersController();
        $api_data = new Request([
            'emp_ev_book_id' => $request->emp_event_id,
            'in_out' => $request->in_out,
            'id' => $userId,
            'auth' => $token
        ]);
        $resp = $api->employeeCheckInOut($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }

    /////////////////// flight save //////////////////////////////////
    public function flightSave(Request $request)
    {
        //print_r($request->all()); die;
        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;

        $flight_book_type = $request->flight_book_type;
        $emp_ev_book_id = $request->emp_ev_book_id;
        $flight_name = $request->flight_name;
        $flight_number = $request->flight_number;
        $date_time = date('Y-m-d H:i:s', strtotime($request->date_time));
        $location = $request->location;


        $api = new ApiUsersController();
        $api_data = new Request([
            'emp_ev_book_id' => $emp_ev_book_id,
            'book_type' => $flight_book_type,
            'flight_name' => $flight_name,
            'flight_number' => $flight_number,
            'flight_dt_tm' => $date_time,
            'flight_location' => $location,
            'id' => $userId,
            'auth' => $token
        ]);
        $resp = $api->flightSave($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }

    public function getHtlCategory(Request $request)
    {
        
        $htl_cd = $request->hotel_cd;
        
        $hotels_category = DB::table('hotels_category')->where('soft_delete_yn', 0)->where('htl_idd', $htl_cd)->get();
        // ->where('vacent_rooms', '>', 0)
        $opts = '';
        if(count($hotels_category) > 1){
            $opts .= '<option value="">Select category</option>';
        }
        foreach ($hotels_category as $key => $category) {
            $htl_cat_id = $category->htl_cat_id;
            $hotel_category = $category->hotel_category;
            $total_rooms = $category->total_rooms;
            $vacent_rooms = $category->vacent_rooms;
            $opts .= '<option value="'.$htl_cat_id.'" data-ttl_room="'.$total_rooms.'" data-vacent="'.$vacent_rooms.'">'.$hotel_category.'</option>';
        }

        return response()->json(['category_list' => $opts]);
    }
    
    public function changeHtlReq(Request $request)
    {
        //print_r($request->all()); die;

        $emp_ev_book_id       = $request->emp_ev_book_id;
        $hotel_cd       = $request->hotel_cd;
        $room_type_cd   = $request->room_type_cd;
        $instructions   = $request->instructions;

        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;
        $api = new ApiUsersController();

        $api_data = new Request([
            'emp_ev_book_id' => $emp_ev_book_id,
            'htl_id' => $hotel_cd,
            'htl_cat_id' => $room_type_cd,
            'instruction' => $instructions,
            'id' => $userId,
            'auth' => $token
        ]);

        $resp = $api->hotelChangeRequest($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }
    
    public function changePassword(Request $request)
    {
        //print_r($request->all()); die;

        $old_password       = $request->old_password;
        $new_password       = $request->new_password;
        $confirm_password   = $request->confirm_password;

        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;
        $api = new ApiUsersController();

        $api_data = new Request([
            'old_password' => $old_password,
            'new_password' => $new_password,
            'confirm_password' => $confirm_password,
            'id' => $userId,
            'auth' => $token
        ]);

        $resp = $api->changePassword($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }
    
    public function userQuery(Request $request)
    {
        //print_r($request->all()); die;

        $emp_ev_book_id = $request->emp_ev_book_id;
        $query          = $request->input('query'); 

        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;
        $api = new ApiUsersController();

        $api_data = new Request([
            'emp_ev_book_id' => @$emp_ev_book_id,
            'query' => $query,
            'id' => $userId,
            'auth' => $token
        ]);

        $resp = $api->userQuery($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }
    
    public function eventCancel(Request $request)
    {
        //print_r($request->all()); die;

        $emp_ev_book_id = $request->emp_ev_book_id;
        $cancel_reason  = $request->input('cancel_reason'); 

        $user = Auth()->user();
        $userId = $user->id;
        $token = $user->login_token;
        $api = new ApiUsersController();

        $api_data = new Request([
            'emp_ev_book_id' => @$emp_ev_book_id,
            'cancel_reason' => $cancel_reason,
            'id' => $userId,
            'auth' => $token
        ]);

        $resp = $api->eventCancel($api_data);
        $responseData = $resp->getData();
        return response()->json($responseData);
    }

    public function pageIndex($page)
    {
        //session(['emp_ev_book_id' => $emp_ev_book_id, 'event_cd' => $event_cd, 'userId' => $userId, 'token' => $token]);
        $emp_ev_book_id = session('emp_ev_book_id');
        $userId         = session('userId');
        $apiData = new Request([
            'emp_ev_book_id' => $emp_ev_book_id,
            'id' => $userId
        ]);
        $api = new ApiUsersController();
        $pg = '';
        $data = [];
        
        $data['emp_ev_book_id'] = $emp_ev_book_id;
        switch ($page) {
            case 'participation':
                $pg = 'user_participation';
            break;
            case 'quiz':
                $pg = 'user_quiz';
            break;
            case 'faq':
                $faqsListQuery = $api->faqsList(); 
                $faqsList = $faqsListQuery->getData();
                $data['faqsList'] = $faqsList;
                $pg = 'user_faq';
            break;
            case 'feedback':
                $apiQuery = $api->feedbackIndex($apiData); 
                $feedbackList = $apiQuery->getData();
                $data['feedbackList'] = $feedbackList;
                $pg = 'user_feedback';
            break;
            case 'flight':
                $pg = 'user_flight';
            break;
            case 'helpdesk':
                $sos_contact = $api->sosContactUs($apiData); 
                $sosData = $sos_contact->getData();
                $data['sos_contact'] = $sosData;
                $pg = 'user_helpdesk';
            break;
            case 'about':
                $pg = 'user_about';
            break;
            case 'change_password':
                $pg = 'user_change_password';
            break;
            case 'day_wise':
                $pg = 'user_event_info';
            break;
            case 'date_wise':
                $pg = 'user_event_info';
            break;

            default:
            // code...
            break;
        }
        return view($pg, $data);
    }

    public function menuPage()
    {
        return view("menus");
    }
}
