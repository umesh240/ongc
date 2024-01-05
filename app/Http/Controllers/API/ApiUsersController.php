<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\EventBook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;


use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventController;

class ApiUsersController extends Controller
{
    
    public function login_API(Request $request)
    {
        //print_r($request->all());
        try {
            $new_token = '';
            $loginValue = $request->email;
            $password = $request->pass;
            $user1 = User::where(['email' => $loginValue, 'actv_status' => 1])->first();
            $user2 = User::where(['cpf_no' => $loginValue, 'actv_status' => 1])->first();
            if ($user1 || $user2) {
                if($user1){
                    $user = $user1;
                }else if($user2){
                    $user = $user2;
                }else{
                    $user = '';
                }
                $new_token = '';
                $status = 400;
                $result = "Something went wrong.";
                if($user && Hash::check($password, @$user->password)){
                    $pre_login_token = @$user->login_token;
                    if(is_null($pre_login_token) || empty($pre_login_token)){
                        //$new_token = bcrypt(str_shuffle(time())); 
                        //$user = User::where(['id' => $user->id, 'email' => $user->email])->first();
                        $new_token = $user->createToken($loginValue)->plainTextToken;
                        $user->login_token = $new_token;
                        
                        $user->save();
                        //$result = User::where(['id' => $user->id, 'email' => $user->email])->first();
                    }else{
                        $new_token = $pre_login_token;
                    }
                    $emp_event_cd = $user->cur_event;
                    $event = new EventController();
                    $wheather = $event->eventWheather($emp_event_cd);
                    $status = 200;
                    $result = $user;
                    return response()->json(['status' => $status, "response" => $result, "token" => $new_token]);
                }else{
                    $status = 401;
                    $result = 'Password mismatch.';
                }
            }else{
                $status = 404;
                $result = 'User not exist.';
            } 
            return response()->json(['status' => $status, "message" => $result]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    public function eventDetails(Request $request)
    {
        try {
            $idd = $request->id;
            $today = date('Y-m-d H:i:s');
            $findEvent = DB::table('events')->where('actv_event', 1)->orderBy('event_datefr', 'asc')->first();
            $ev_id = @$findEvent->ev_id;

            $user1 = EventBook::where('emp_cd', $idd)->where('status_in_htl', 1)
                                ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                                ->with(['hotelDetails', 'categoryDetails', 'shareUserDetails'])
                                ->where('events.actv_event', 1)->orderBy('events.event_datefr', 'ASC')->first();
            // 'eventDetails', 
            $status = 200;
            if($user1){
                $airports = $user1->airports;
                $airports = json_decode($airports);
                $user1->airports = $airports;
                $weather_result = $user1->weather_result;
                $weather_result = json_decode($weather_result);
                $user1->weather_result = $weather_result;
                
                $photo_path = asset('/storage/app/leaders_photo/').'/';
                $boardDirectors = DB::table('leaders')->where('delete_status', 0)->select('l_name', 'l_post', DB::raw("CONCAT('$photo_path', l_photo) as l_photo"))->orderBy('order_by', 'asc')->get();
                $user1->boardDirectors = $boardDirectors;
                $socialLinks = DB::table('social_links')->where('sc_show', 1)->whereNotNull('sc_link')->select('sc_name', 'sc_icon', 'sc_link')->get();
                $user1->socialLinks = $socialLinks;
                $aboutDetails = DB::table('abouts')->first();
                $user1->aboutDetails = $aboutDetails;
                $data = $user1;
            }else{
                $data = NUll;
            }
            return response()->json(['status' => $status, "response" => $data]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }


    public function profile(Request $request)
    {
        try {
            $idd = $request->id;
            $user1 = User::where(['id' => $idd, 'actv_status' => 1])->first();
            $status = 400;
            if($user1){
                $status = 200;
                return response()->json(['status' => $status, 'response' => $user1]);
            }else{
                $status = 401;
                $result = 'user not found.';
                return response()->json(['status' => $status, "message" => $result]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }
    public function employeeCheckInOut(Request $request)
    {

        try {
            //$today = date('Y-m-d H:i:s');
            $emp_event_id = $request->emp_ev_book_id;
            $today = $date = $request->date;
            if($date == null || $date == '' || $date == '0000-00-00' || $date == '0000-00-00 00:00:00'){
                $today = date('Y-m-d H:i:s');
            }
            //print_r($today); die;
            $in_out = strtolower($request->in_out);
            $findQuery = DB::table('event_books_emp')
                            ->leftJoin('events', 'events.ev_id', '=', 'event_books_emp.emp_event_cd')
                            ->where('emp_ev_book_id', $emp_event_id)->first();
            //print_r($findQuery); die;
            $status = 400;
            if($findQuery){
                $status = 200;
                $check_in = $findQuery->check_in;
                $event_datefr = $findQuery->event_datefr;
                $event_dateto = $findQuery->event_dateto;
                $assign_check_in = $findQuery->assign_check_in;
                $assign_check_out = $findQuery->assign_check_out;
                $event_datefr1 = date('Y-m-d', strtotime($assign_check_in));
                $event_dateto1 = date('Y-m-d', strtotime($assign_check_out));
                if(is_null($assign_check_in) || empty($assign_check_in)){
                    $event_datefr1 = date('Y-m-d', strtotime($event_datefr));
                    $event_dateto1 = date('Y-m-d', strtotime($event_dateto));
                }
                $today1 = date('Y-m-d', strtotime($today));
                if(strtotime($today1) < strtotime($event_datefr1) || strtotime($today1) > strtotime($event_dateto1)){

                    $status = 401;
                    $message = "this is not a valid time for check-in/check-out.";
                    return response()->json(['status' => $status, 'message' => $message]);
                }
                $check_in_out = [];
                if($in_out == 'in'){
                    $check_in_out['check_in'] = $today;
                }else if($in_out == 'out'){
                    if(is_null($check_in) || strtotime($check_in) <= 0){
                        return response()->json(['status' => 401, 'message' => 'first need to check-in.']);
                    }
                    $check_in_out['check_out'] = $today;
                }else{
                    return response()->json(['status' => 401, 'message' => 'Something error. Not updated.']);
                }
                $runQuery = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_event_id)->update($check_in_out);
                if($runQuery){
                    $status = 200;
                    $message = "check-".$in_out." updated.";
                }else{
                    $status = 401;
                    $message = "check-".$in_out." not updated.";
                }
                return response()->json(['status' => $status, 'message' => $message, 'check_date' => $today]);
            }else{
                $status = 401;
                $result = 'user not found.';
                return response()->json(['status' => $status, "message" => $result]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }
    public function flightSave(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $validator = Validator::make($request->all(), [
                'emp_ev_book_id' => 'required',
                'flight_number' => 'required',
                'flight_dt_tm' => 'date_format:Y-m-d H:i:s',
            ],[
                'emp_ev_book_id.required' => 'Event must be selected.',
                'flight_number.required' => 'Flight number is required field',
                'flight_dt_tm.date_format' => 'Date time field must be in valid date format Y-m-d H:i:s.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }

            $book_type          = strtolower($request->book_type);
            $user_id            = $request->id;
            $emp_ev_book_id     = $request->emp_ev_book_id;
            $flight_name        = $request->flight_name;
            $flight_number      = $request->flight_number;
            $flight_dt_tm       = $request->flight_dt_tm;
            $flight_location    = $request->flight_location;
            $today              = date('Y-m-d H:i:s');

            $flightArr = [];
            if($book_type == 'arr'){
                $flightArr['arv_flight_name']       = $flight_name;
                $flightArr['arv_flight_no']         = $flight_number;
                $flightArr['arv_date_time']         = $flight_dt_tm;
                $flightArr['arv_location']          = $flight_location;
                $flightArr['flight_create_date']    = $today;
                $flight_type = "arrival";
            }else{
                $flightArr['dptr_flight_name']      = $flight_name;
                $flightArr['dptr_flight_no']        = $flight_number;
                $flightArr['dptr_date_time']        = $flight_dt_tm;
                $flightArr['dptr_location']         = $flight_location;
                $flightArr['flight_create_date']    = $today;
                $flight_type = "departure";
            }
            $flightArr['flight_status'] = 2;

            $queryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)
                                                        ->update($flightArr);
            if($queryRun){

                $mail = new EmailController();
                if($emp_ev_book_id > 0){
                    $user = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)->first();
                    $user_email = $user->user_email;
                    $user_name = $user->user_name;
                    $user_cpfno = $user->user_cpfno;
                    $user_designation = $user->user_designation;
                    $user_mobile = $user->user_mobile;
                }else{
                    $user = DB::table('users')->where('id', $user_id)->first();
                    $user_email = $user->email;
                    $user_name = $user->name;
                    $user_cpfno = $user->cpf_no;
                    $user_designation = $user->designation;
                    $user_mobile = $user->mobile;
                }
                $flightInfo = "";
                $flightInfo .= "<p style='margin:0;'>".ucfirst($flight_type)." flight details are below :</p><br>";
                if(!empty(trim($flight_name))){
                    $flightInfo .= "<p style='margin:0;'><b>Flight Name : </b>".$flight_name."</p>";
                }
                $flightInfo .= "<p style='margin:0;'><b>Flight No. : </b>".$flight_number."</p>";
                $flightInfo .= "<p style='margin:0;'><b>".ucfirst($flight_type)." Date : </b>".date('d/m/Y h:i A', strtotime($flight_dt_tm))."</p>";
                if(!empty(trim($flight_name))){
                    $flightInfo .= "<p style='margin:0;'><b>".ucfirst($flight_type)." Location : </b>".$flight_location."</p>";
                }
                $flightInfo .= "<p style='margin:0;'><b>Submit Date : </b>".date('d/m/Y h:i A', strtotime($today))."</p>";

                $userEmailSubject = "Flight information Submitted (".ucfirst($flight_type).")";
                $userEmailContent = "";
                $userEmailContent .= "<html><body>";
                $userEmailContent .= "<h4 style='margin:0;'>Dear ".$user_name.",</h4>";
                $userEmailContent .= "<p style='margin:0;'>Your ".$flight_type." flight information saved & send to the admin.</p>";
                $userEmailContent .= $flightInfo;
                $userEmailContent .= "<p style='margin:0;'><br><br><br><b>Thanks</b></p>";
                $userEmailContent .= "</body></html>";
                $mail->sendMail($userEmailContent, $userEmailSubject, $user_email);

                $adminEmailSubject = "Flight information Received (".ucfirst($flight_type).")";
                $adminEmailContent = "";
                $adminEmailContent .= "<html><body>";
                $adminEmailContent .= "<p style='margin:0;'>User ".$user_name." send a flight information.</p>";
                $adminEmailContent .= $flightInfo;
                $adminEmailContent .= "<p style='margin:0;'><b>Name : </b>".$user_name."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>CPF No. : </b>".$user_cpfno."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Email-id : </b>".$user_email."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Mobile No. : </b>".$user_mobile."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Designation : </b>".$user_designation."</p>";
                $adminEmailContent .= "</body></html>";
                $adminEmailId = env('ADMIN_EMAIL');
                $mail->sendMail($adminEmailContent, $adminEmailSubject, $adminEmailId);

                $status = 200;
                $message = "Flight details updated successfully.";
            }else{
                $status = 400;
                $message = "Flight details are already updated.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    public function hotelList(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $event_cd = $request->emp_event_cd;
            if($event_cd <= 0 || $event_cd == ''){
                return response()->json(['status' => 400, "message" => "Event not selected."]);
            }
            $hotel_list = DB::table('hotels')->where('evv_id', $event_cd)->where('actv_hotel', 1)->select("htl_id", "hotel_name", "hotel_address", "evv_id")->get();
            return response()->json(['status' => 200, "response" => $hotel_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    public function roomTypeList(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $htl_id = $request->htl_id;
            if($htl_id <= 0 || $htl_id == ''){
                return response()->json(['status' => 400, "message" => "Hotel not selected."]);
            }
            $hotel_list = DB::table('hotels_category')->where('htl_idd', $htl_id)->where('soft_delete_yn', 0)->select("htl_cat_id", "hotel_category", "hotel_nm", "evv_id")->get();
            return response()->json(['status' => 200, "response" => $hotel_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    public function hotelChangeRequest(Request $request)
    {
        //print_r($request->all()); die;
        try {

            $validator = Validator::make($request->all(), [
                'emp_ev_book_id' => 'required',
                'htl_id' => 'required',
                'htl_cat_id' => 'required'
            ],[
                'emp_ev_book_id.required' => 'Event not matched.',
                'htl_id.required' => 'Hotel is required field.',
                'htl_cat_id.required' => 'Room type is required field.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('\n', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }
            $today = date('Y-m-d H:i:s');
            $user_id = $request->id;
            $emp_ev_book_id = $request->emp_ev_book_id;
            $hotel_cd = $request->htl_id;
            $htl_cat_id = $request->htl_cat_id;
            $instruction = $request->instruction;

            $queryFind = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)
                                ->where('emp_hotel_cd', $hotel_cd)->where('emp_hotel_cat_cd', $htl_cat_id)->first();
            if($queryFind){
                return response()->json(['status' => 200, "message" => "The same hotel & room type already assigned you."]);
            }

            $htlData = [];
            $htlData['req_chng_hotel_cd']       = $hotel_cd;
            $htlData['req_chng_hotel_cat_cd']   = $htl_cat_id;
            $htlData['req_chng_instraction']    = $instruction;
            $htlData['req_chng_date']           = $today;
            $htlData['req_chng_status']         = 1;


            $queryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)
                                ->update($htlData);

            if($queryRun){
                /// email send functionality is pending. /// now remove the hotel change request on 30/10/23
                $status = 200;
                $message = "Request submitted successfully.";
            }else{
                $status = 400;
                $message = "Request are already submitted.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }


    public function forgotPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            $allErrors = $validator->errors()->all();
            $allErrors = implode('<br>', $allErrors);
            return response()->json(['message' => $allErrors, 'status' => 400], 422);
        }

        /*
        $email_test = @$request->email_test;
        if(trim($email_test) != ''){
            $email = $email_test;
        }*/
        // Send the password reset email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the response and provide appropriate feedback to the user
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['status' => 200, 'message' => 'Password reset link sent!']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Unable to send reset link. Please try again later.']);
        }
    }

    public function logOut(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }

            $queryRun = User::where('id', $request->id)->update(['login_token' =>  NULL]);

            if($queryRun){
                $status = 200;
                $message = "Logout successfully.";
            }else{
                $status = 400;
                $message = "Something problem occur.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }

    }

    public function sosContactUs(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $emp_ev_book_id = @$request->emp_ev_book_id;

            if($emp_ev_book_id > 0){
                $sos_contact = DB::table('event_books_emp')
                        ->select('contactsos.email_id', 'contactsos.phone_no', 'contactsos.sos_info', 'event_books_emp.emp_hotel_cd', 'hotels.fpr_name', 'hotels.fpr_mob_no', 'hotels.hosp_fpr_name', 'hotels.hosp_fpr_mob_no')
                        ->leftJoin('hotels', 'hotels.htl_id', '=', 'event_books_emp.emp_hotel_cd')
                        ->crossJoin('contactsos')->where('emp_ev_book_id', $emp_ev_book_id)->first();
            }else{
                $sos_contact = DB::table('contactsos')->select('email_id', 'phone_no', 'sos_info', DB::raw('0 as emp_hotel_cd'), DB::raw('"" as fpr_name'), DB::raw('"" as fpr_mob_no'), DB::raw('"" as hosp_fpr_name'), DB::raw('"" as hosp_fpr_mob_no'))->first();
            }


            if($sos_contact){
                $status = 200;
                return response()->json(['status' => $status, "response" => $sos_contact]);
            }else{
                $status = 400;
                $message = "Something problem occur.";
                return response()->json(['status' => $status, "message" => $message]);
            }
            
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    public function changePassword(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password'
            ],[
                'id.required' => 'User not logged-in.',
                'old_password.required' => 'Old password is required field.',
                'new_password.required' => 'New password is required field.',
                'new_password.min' => 'New password will be minimum 6 char long.',
                'confirm_password.same' => 'Confirm password mismatch with new password.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }
            $user_id = $request->id;
            $old_password = $request->old_password;
            $new_password = $request->new_password;       

            $user_find = User::where('id', $user_id)->first();
            $saved_password = $user_find->password;
            if ($old_password === $new_password) {
                return response()->json(['message' => 'Old & New password is same. It will be different', 'status' => 400], 400);
            }
            if (!password_verify($old_password, $saved_password)) {
                return response()->json(['message' => 'Old password is incorrect.', 'status' => 400], 400);
            }
            $new_passwordHsah = Hash::make($new_password);
            $queryRun = User::where('id', $user_id)->update(['password' =>  $new_passwordHsah]);

            if($queryRun){
                $status = 200;
                $message = "Password changed successfully.";
            }else{
                $status = 400;
                $message = "Password not changed. Something problem occur.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }

    }
    public function userQuery(Request $request)
    {
        //print_r($request->all()); die;
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'query_reason' => 'required'
            ],[
                'id.required' => 'User not logged-in.',
                'query_reason.required' => 'Query is required field.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }
            $user_id = $request->id;
            $emp_ev_book_id = @$request->input('emp_ev_book_id', null);
            //$query_type = $request->input('query_type'); 
            $query_type = ''; 
            $query = $request->input('query_reason'); 
            $today = date('Y-m-d H:i:s');

            $queryData = [];
            $queryData['user_id'] = $user_id;
            $queryData['query_type'] = $query_type;
            $queryData['query'] = $query;
            $queryData['event_id'] = $emp_ev_book_id;
            $queryData['created_at'] = $today;
            $queryData['query_status'] = 1;

            $row_id = 0;
            $queryRun = DB::table('queries')->insert($queryData);
            if($queryRun){
                $mail = new EmailController();
                if($emp_ev_book_id > 0){
                    $user = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)->first();
                    $row_id = @$user->emp_ev_book_id;
                    if($row_id > 0){
                        $user_email = $user->user_email;
                        $user_name = $user->user_name;
                        $user_cpfno = $user->user_cpfno;
                        $user_designation = $user->user_designation;
                        $user_mobile = $user->user_mobile;
                    }
                }else{
                    $user = DB::table('users')->where('id', $user_id)->first();
                    $row_id = @$user->id;
                    if($row_id > 0){
                        $user_email = $user->email;
                        $user_name = $user->name;
                        $user_cpfno = $user->cpf_no;
                        $user_designation = $user->designation;
                        $user_mobile = $user->mobile;
                    }
                }
                if($row_id > 0){
                    $userEmailSubject = "Query Request";
                    $userEmailContent = "";
                    $userEmailContent .= "<html><body>";
                    $userEmailContent .= "<h4 style='margin:0;'>Dear ".$user_name.",</h4>";
                    $userEmailContent .= "<p style='margin:0;'>Your query submitted successfully. We have replied as soon as possible.</p>";
                    $userEmailContent .= "<p style='margin:0;'>Your query details are below :</p><br>";
                    $userEmailContent .= "<p style='margin:0;'><b>Query : </b>".$query."</p>";
                    $userEmailContent .= "<p style='margin:0;'><b>Date : </b>".date('d/m/Y h:i A', strtotime($today))."</p>";
                    $userEmailContent .= "<p style='margin:0;'><br><br><br><b>Thanks</b></p>";
                    $userEmailContent .= "</body></html>";
                    $mail->sendMail($userEmailContent, $userEmailSubject, $user_email);

                    $adminEmailSubject = "Query Received";
                    $adminEmailContent = "";
                    $adminEmailContent .= "<html><body>";
                    $adminEmailContent .= "<p style='margin:0;'>User ".$user_name." send a query</p>";
                    $adminEmailContent .= "<p style='margin:0;'>User's Query details are below :</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Name : </b>".$user_name."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>CPF No. : </b>".$user_cpfno."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Email-id : </b>".$user_email."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Mobile No. : </b>".$user_mobile."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Designation : </b>".$user_designation."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Query : </b>".$query."</p>";
                    $adminEmailContent .= "<p style='margin:0;'><b>Date : </b>".date('d/m/Y h:i A', strtotime($today))."</p>";
                    $adminEmailContent .= "</body></html>";
                    $adminEmailId = env('ADMIN_EMAIL');
                    $mail->sendMail($adminEmailContent, $adminEmailSubject, $adminEmailId);
                }
                $status = 200;
                $message = "Query saved successfully.";
            }else{
                $status = 400;
                $message = "Query not saved. Something problem occur.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }
    public function eventCancel(Request $request)
    {
        //print_r($request->all()); die;
        try {    
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'emp_ev_book_id' => 'required',
                'cancel_type' => 'required|min:2',
            ],[
                'id.required' => 'User not logged-in.',
                'emp_ev_book_id.required' => 'Event not selected.',
                'cancel_type.required' => 'Reason is required field.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }
            $user_id        = $request->id;
            $emp_ev_book_id = $request->emp_ev_book_id;
            $cancel_reason  = $request->cancel_reason; 
            $cancel_type  = $request->cancel_type; 
            $today          = date('Y-m-d H:i:d'); 

            $evCancelData = [];
            $evCancelData['cancel_reason']    = $cancel_reason;
            $evCancelData['cancel_type']    = $cancel_type;
            $evCancelData['cancel_date']      = $today;
            $evCancelData['cancel_status']    = 1;
            //$evCancelData['status_in_htl']    = 0;
            $evCancelData['updated_at']       = $today;


            $queryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)
                                ->update($evCancelData);
            if($queryRun){
                $user = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)->first();
                $user_email = $user->user_email;
                $user_name = $user->user_name;
                $user_cpfno = $user->user_cpfno;
                $user_designation = $user->user_designation;
                $user_mobile = $user->user_mobile;

                $mail = new EmailController();
                $adminEmailSubject = "Event Withdrawn/ Cancellation";
                $adminEmailContent = "";
                $adminEmailContent .= "<html><body>";
                $adminEmailContent .= "<p style='margin:0;'>User ".$user_name." withdrawn/ cancellation the event.</p>";
                $adminEmailContent .= "<p style='margin:0;'>Event withdrawn/ cancellation details are below :</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Name : </b>".$user_name."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>CPF No. : </b>".$user_cpfno."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Email-id : </b>".$user_email."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Mobile No. : </b>".$user_mobile."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Designation : </b>".$user_designation."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Reason : </b>".$cancel_reason."</p>";
                $adminEmailContent .= "<p style='margin:0;'><b>Date : </b>".date('d/m/Y h:i A', strtotime($today))."</p>";
                $adminEmailContent .= "</body></html>";
                $adminEmailId = env('ADMIN_EMAIL');
                $mail->sendMail($adminEmailContent, $adminEmailSubject, $adminEmailId);

                $status = 200;
                $message = "Cancelled successfully.";
            }else{
                $status = 400;
                $message = "Cancellation failled.";
            }
            return response()->json(['status' => $status, "message" => $message]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }

    
    public function quizIndex(Request $request)
    {
        $emp_ev_book_id = $request->emp_ev_book_id;
        $user_id        = $request->id;
        $quizUser = DB::table('quiz_user')->where('user_id', $user_id)->where('emp_event_id', $emp_ev_book_id)->first();
        //print_r($quizUser); die;
        if($quizUser){
            $ttl_question   = $quizUser->ttl_question;
            $right_question = $quizUser->right_question;
            $wrong_question = $quizUser->wrong_question;
            $response = [];
            $response["message"] = 'Dear user you have successfully submitted your quiz.';
            $response["total_question"] = "Attempt Question : ".$ttl_question;
            $response["right_question"] = "Right Answer : ".$right_question;
            $response["wrong_question"] = "Wrong Answer : ".$wrong_question;
            $status = 200;
            return response()->json(['status' => $status, "response" => $response, "submitted" => 1]);
        }
        else{
            $questionLimit = 10;
            $quizList = DB::table('quizs')->where('delete_yn', 0)->select('qz_id', 'question', 'option_1', 'option_2', 'option_3', 'option_4')->inRandomOrder()->take($questionLimit)->get();
            // , 'answer'
            $recordCount = $quizList->count();
            if($recordCount > 0){
                $quizArr = [];
                foreach ($quizList as $key => $quiz) {
                    $qz_id = $quiz->qz_id;
                    $question = $quiz->question;
                    $option_1 = $quiz->option_1;
                    $option_2 = $quiz->option_2;
                    $option_3 = $quiz->option_3;
                    $option_4 = $quiz->option_4;
                    $quizArr[] = [
                        'qz_id' => $qz_id,
                        'question' => $question,
                        'options' => [$option_1, $option_2, $option_3, $option_4],
                    ];
                }
                //$quizArr = json_encode($quizArr);
                $status = 200;
                return response()->json(['status' => $status, "response" => $quizArr, "submitted" => 0]);
            }else{
                $status = 400;
                return response()->json(['status' => $status, "message" => "No quiz's questions found.", "submitted" => 0]);
            }
        }
    }

    
    public function quizSave(Request $request)
    {
        $emp_ev_book_id = $request->emp_ev_book_id;
        $user_id = $request->user_id;
        $quiz_completed = $request->quiz_completed;
        $quiz_completed_cnt = count($quiz_completed);

        foreach ($quiz_completed as $key => $quiz) {
            $answer_id = $quiz['answer_id'];
            if($answer_id <= 0 || $user_id <= 0){
                $qs_no = $key + 1;
                return response()->json(['message' => 'Choose the answer of question no. '.$qs_no, 'status' => 400], 400);
            }
        }

        $correct_answer = $worng_answer = 0;
        $questionsData = $allQuestion = [];
        foreach ($quiz_completed as $key => $quiz) {
            $question_id = $quiz['question_id'];
            $answer_id = $quiz['answer_id'];

            $quizGet = DB::table('quizs')->where('qz_id', $question_id)->select('qz_id', 'question', 'answer', 'used_times')->first();
            $right_answer = $quizGet->answer;
            $r_w = 0;
            if($answer_id == $right_answer){
                $correct_answer++;
                $r_w = 1;
            }else{
                $worng_answer++;
                $r_w = 0;
            }

            $questionsData['question']      = $question_id;
            $questionsData['user_answer']   = $answer_id;
            $questionsData['right_answer']  = $right_answer;
            $questionsData['result']        = $r_w;

            $allQuestion[] = $questionsData;
            $quizUpdate = DB::table('quizs')->where('qz_id', $question_id)->increment('used_times');

        }
        $allQuestion = json_encode($allQuestion);
        $userQuizData = [];
        $userQuizData['all_answers']        = $allQuestion;
        $userQuizData['ttl_question']       = $quiz_completed_cnt;
        $userQuizData['right_question']     = $correct_answer;
        $userQuizData['wrong_question']     = $worng_answer;
        $userQuizData['user_id']            = $user_id;
        $userQuizData['emp_event_id']       = $emp_ev_book_id;
        $userQuizData['created_at']         = date('Y-m-d H:i:s');

        $quizSaveQuery = DB::table('quiz_user')->insert($userQuizData);
        if($quizSaveQuery){
            return response()->json(['status' => 200, "message" => "Quiz saved successfully.", "ttl_question" => $quiz_completed_cnt, "right_question" => $correct_answer, "wrong_question" => $worng_answer]);
        }else{
            return response()->json(['status' => 400, "message" => "Quiz not saved."]);
        }
    }


    
    public function feedbackIndex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'emp_ev_book_id' => 'required'
        ],[
            'id.required' => 'User not logged-in.',
            'emp_ev_book_id.required' => 'Event not selected.'
        ]);

        if ($validator->fails()) {
            $allErrors = $validator->errors()->all();
            $allErrors = implode('<br>', $allErrors);
            return response()->json(['message' => $allErrors, 'status' => 400], 422);
        }
        $user_id        = $request->id;
        $emp_ev_book_id = $request->emp_ev_book_id;

        $response = [];
        $savedFeedBack = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)->select('all_feedbacks', 'suggestion', 'feedbacks_submit')->first();
        $all_feedbacks = @$savedFeedBack->all_feedbacks;
        $suggestion    = @$savedFeedBack->suggestion;
        $submited      = @$savedFeedBack->feedbacks_submit;
        if($submited == 1){
            $recordCount = 1;
            $all_feedbacks = json_decode($all_feedbacks, true);
            $response['feedback_list']  = $all_feedbacks;
            $response['suggestion']     = $suggestion;
        }else{
            $feedback_list = DB::table('feedbacks')->where('delete_yn', 0)->select('fb_id', DB::raw('0 as rating'), 'feedback')->orderByRaw('order_by = 0, order_by asc')->get();
            $recordCount = $feedback_list->count();
            $response['feedback_list'] = $feedback_list;
            $response['suggestion'] = "";
        }
        $response['submitted']      = $submited;
        if($recordCount > 0){
            $status = 200;
            return response()->json(['status' => $status, "response" => $response]);
        }else{
            $status = 400;
            return response()->json(['status' => $status, "message" => "No feedback found."]);
        };
    }
    
    public function feedbackSave(Request $request)
    {
        try {    
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'emp_ev_book_id' => 'required'
            ],[
                'id.required' => 'User not logged-in.',
                'emp_ev_book_id.required' => 'Event not selected.'
            ]);

            if ($validator->fails()) {
                $allErrors = $validator->errors()->all();
                $allErrors = implode('<br>', $allErrors);
                return response()->json(['message' => $allErrors, 'status' => 400], 422);
            }
            $user_id        = $request->id;
            $emp_ev_book_id = $request->emp_ev_book_id;
            $feedback_all   = $request->feedbacks; 
            $suggestion     = $request->suggestion; 
            $today          = date('Y-m-d H:i:d'); 

            
            foreach ($feedback_all as $key => $feedback) {
                $rating = $feedback['rating'];
                if($rating <= 0){
                    $qs_no = $key + 1;
                    return response()->json(['message' => 'Rating of feedback no. '.$qs_no.' is required.', 'status' => 400], 400);
                }
            }
            $feedbackAll = [];
            foreach ($feedback_all as $key => $feedback) {
                $rating = $feedback['rating'];
                $fb_id = $feedback['fb_id'];

                $feedback_list = DB::table('feedbacks')->where('fb_id', $fb_id)->select('fb_id', 'feedback')->first();
                $feedbackTxt = $feedback_list->feedback;

                $feedback['feedback'] = $feedbackTxt;
                $feedbackAll[] = $feedback;
            }
            $feedbacks      = json_encode($feedbackAll);
            $feedbackData = [];
            $feedbackData['all_feedbacks']      = $feedbacks;
            $feedbackData['suggestion']         = $suggestion;
            $feedbackData['feedbacks_submit']   = 1;
            $feedbackSave = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_ev_book_id)->where('emp_cd', $user_id)->update($feedbackData);
            //print_r($feedbackSave); die;

            if($feedbackSave){
                $status = 200;
                return response()->json(['status' => $status, "message" => "Feedback saved successfully."]);
            }else{
                $status = 400;
                return response()->json(['status' => $status, "message" => "Feedback not saved. Try again."]);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }



    public function faqsList()
    {
        try { 
            $faqs_list = DB::table('faqs')->where('delete_yn', 0)->orderByRaw('order_by = 0, order_by asc')
                        ->select('faq_id', 'question', 'answer')->get();
            //$data['faqs_list'] = $faqs_list;
            $status = 200;
            return response()->json(['status' => $status, "response" => $faqs_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, "message" => $e->getMessage()]);
        }
    }
}
