<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\EmailController;

class UserController extends Controller
{
    private $api_url = 'http://127.0.0.1:8000/api/';
    //private $api_url = 'http://localhost/api/';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo '<br>-------------------------------------------------</br>'; print_r($search); die;
        $length = request('length', null); // Default to null if not provided
        $search = request('search', null); // Default to null if not provided
        $event_code = request('event_code', null);
        $level_code = request('level_code', null);
        $hotel_code = request('hotel_code', null);

        if(empty($length)){
            $length = 10;
        }
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        $employee_list = DB::table('users')
                    ->when($event_code > 0, function ($query) use ($event_code, $hotel_code) {
                        $query->rightJoin('event_books_emp', 'event_books_emp.emp_cd', '=', 'users.id')
                                ->where('event_books_emp.emp_event_cd', $event_code)->where('event_books_emp.status_in_htl', 1)
                                ->when($hotel_code > 0, function ($query) use ($hotel_code) {
                                    $query->where('event_books_emp.emp_hotel_cd', $hotel_code);
                                });
                    })
                    ->when(!empty($level_code), function ($query) use ($level_code, $event_code) {
                        $query->when($event_code > 0, function ($query) use ($level_code) {
                            $query->where('event_books_emp.user_level', $level_code);
                        }, function ($query) use ($level_code) {
                            // Condition B
                            $query->where('users.level', $level_code);
                        });
                    })
                    ->where(function ($query) use ($search) {
                        $query->where('users.name', 'like', '%'.$search.'%')
                        ->orWhere('users.email', 'like', '%'.$search.'%')
                        ->orWhere('users.cpf_no', 'like', '%'.$search.'%')
                        ->orWhere('users.mobile', 'like', '%'.$search.'%');
                    })->where(function ($query) {
                        $query->whereIn('users.user_type', [1, 2]);
                    })->where('users.actv_status', 1)
                    ->paginate($length);

        $events_list = DB::table('event_books_emp')->select('event_books_emp.emp_event_cd', 'events.*')
                    ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                    ->distinct()->get();
        if($event_code > 0){
            $level_list = DB::table('event_books_emp')->select('user_level as level')->whereNotNull('user_level')
                            ->orderBy('user_level', 'asc')->where('status_in_htl', 1)->distinct()->get(); 
        }else{
            $level_list = DB::table('users')->select('level')->whereNotNull('level')->orderBy('level', 'asc')->distinct()->get(); 
        }
        $hotel_list = DB::table('event_books_emp')->select('event_books_emp.emp_hotel_cd', 'hotels.htl_id', 'hotels.hotel_name')
                        ->leftJoin('hotels', 'event_books_emp.emp_hotel_cd', '=', 'hotels.htl_id')
                        ->where('hotels.actv_hotel', 1)->where('event_books_emp.status_in_htl', 1)->groupBy('event_books_emp.emp_hotel_cd')->get(); 
        $data['level_list'] = $level_list; 
        $data['hotel_list'] = $hotel_list; 
        $data['events_list'] = $events_list;  
        $data['event_code'] = $event_code;
        $data['employee_list'] = $employee_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        $data['level_code'] = $level_code;
        $data['hotel_code'] = $hotel_code;
        return view('employee', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($ae, $id = 0, $event_id = 0)
    {
        $data = [];
        if($id > 0){
            $employee = DB::table('users')->where('actv_status', 1)->where('id', $id)->first();
            $emp_event_cd = $employee->cur_event;
            $query = DB::table('event_books_emp')->where('status_in_htl', 1)->where('emp_cd', $id)
                        ->where('emp_ev_book_id', $event_id);
            if ($ae == 'hotel') {
                $query->leftJoin('hotels', 'event_books_emp.req_chng_hotel_cd', '=', 'hotels.htl_id')
                      ->leftJoin('hotels_category', 'event_books_emp.req_chng_hotel_cat_cd', '=', 'hotels_category.htl_cat_id')
                      ->select('event_books_emp.*', 'hotels.htl_id', 'hotels.hotel_name', 'hotels_category.htl_cat_id', 'hotels_category.hotel_category');
            }else{
                $query->select('event_books_emp.*');
            }
            $event = $query->first();

            $data['employee'] = $employee;
            $data['event'] = $event;
            //echo '<pre>'; print_r($employee);  print_r($event); die;
        }
        
        $event_list = DB::table('events')->where('actv_event', 1)->get();
        $hotel_list = DB::table('hotels')->where('actv_hotel', 1)->get();
        $data['event_list'] = $event_list;
        $data['hotel_list'] = $hotel_list;
        $data['event_id'] = $event_id;
        $data['page_type'] = $ae;
        return view('employeeae', $data);
    }

    public function update(Request $request)
    {
        //print_r($request->all()); die;
        $cd = @$request->cd;
        $page_type = @$request->page_type;
        $validateData = Validator::make($request->all(), [
            'cpf_no' => ['required', 'unique:users,cpf_no, '.$cd.',id'],
            'name' => ['required'],
            'email' => ['required', 'unique:users,email, '.$cd.',id'],
            'level' => ['required'],
            'designation' => ['required'],
            'category' => ['required']
        ], [
            'cpf_no.required' => 'CPF no. is required field.',
            'name.required' => 'Name is required field.',
            'email.required' => 'Email is is required field.',
            'designation.required' => 'Designation is required field.',
            'category.required' => 'Category is required field.',
            'level.required' => 'Level is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event'){
            $validateEvent = Validator::make($request->all(), [
                'eventcd' => ['required'],
                'hotel_cd' => ['required'],
                'room_categorycd' => ['required']
            ], [
                'eventcd.required' => 'Event name is required field.',
                'hotel_cd.required' => 'Hotel name is required field.',
                'room_categorycd.required' => 'Hotel category is required field.'
            ]); 
     
            if($validateEvent->fails()){
                return redirect()->back()->withErrors($validateEvent)->withInput();
            }
            $eventcd = @$request->eventcd;
            $user_exist = DB::table('event_books_emp')->where('status_in_htl', 1)->where('emp_cd', $cd)->where('emp_event_cd', $eventcd)->exists();
            if($user_exist && ($cd <= 0 || $cd == '')){
                return redirect()->back()->withErrors(['eventcd' => "This user is already registred for selected event."])->withInput();
            }
        }

        $name = ucwords(@$request->name);
        $email = @$request->email;
        $cpf_no = @$request->cpf_no;
        $eventcd = @$request->eventcd;
        $hotel_cd = @$request->hotel_cd;
        $room_categorycd = @$request->room_categorycd;
        $share_room_with = $share_room_with_empcd = @$request->emp_ShareRm;

        $arv_flight_name        = @$request->arv_flight_name;
        $arv_flight_number      = @$request->arv_flight_number;
        $arv_date_time          = @$request->arv_date_time;
        $arv_flight_location    = @$request->arv_flight_location;

        $dpt_flight_name        = @$request->dpt_flight_name;
        $dpt_flight_number      = @$request->dpt_flight_number;
        $dpt_date_time          = @$request->dpt_date_time;
        $dpt_flight_location    = @$request->dpt_flight_location;

        $drvr_number            = @$request->drvr_number;
        $vehicle_details        = @$request->vehicle_details;
        $assign_check_in        = @$request->assign_check_in;
        $assign_check_out       = @$request->assign_check_out;
        $drvr_name              = NULL;

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $row_dataE = $row_data = [];
        $row_data['name']           = $name;
        $row_data['cpf_no']         = @$cpf_no;
        $row_data['email']          = @$email;
        $row_data['mobile']         = @$request->mobile;
        $row_data['level']          = ucwords(@$request->level);
        $row_data['designation']    = ucwords(@$request->designation);
        $row_data['category']       = ucwords(@$request->category);
        $row_data['location']       = ucwords(@$request->location);
        if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event'){
            $row_data['cur_event']          = @$eventcd;
            $row_data['cur_hotel']          = @$hotel_cd;
            $row_data['cur_category']       = @$room_categorycd;
            $row_dataE['assign_check_in']   = date('Y-m-d H:i:s', strtotime(@$assign_check_in));
            $row_dataE['assign_check_out']   = date('Y-m-d H:i:s', strtotime(@$assign_check_out));

            if(!empty(trim($arv_flight_number))){
                $row_dataE['arv_flight_name']    = ucwords(@$arv_flight_name);
                $row_dataE['arv_flight_no']      = @$arv_flight_number;
                $row_dataE['arv_date_time']      = date('Y-m-d H:i:s', strtotime(@$arv_date_time));
                $row_dataE['arv_location']       = ucwords(@$arv_flight_location);
                $row_dataE['flight_create_date'] = $today;
            }
            if(!empty(trim($dpt_flight_number))){
                $row_dataE['dptr_flight_name']    = ucwords(@$dpt_flight_name);
                $row_dataE['dptr_flight_no']      = @$dpt_flight_number;
                $row_dataE['dptr_date_time']      = date('Y-m-d H:i:s', strtotime(@$dpt_date_time));
                $row_dataE['dptr_location']       = ucwords(@$dpt_flight_location);
            }
            if(!empty(trim($drvr_number))){
                $row_dataE['drvr_number']        = @$drvr_number;
                $row_dataE['drvr_veh_details']   = strtoupper(@$vehicle_details);
                $row_dataE['drvr_name']          = ucwords(@$drvr_name);
            }
        }

        $intcd = @$request->intcd;
        if($cd > 0){
            $emp_cd = $cd;
            $row_data['updated_at'] = $today;
            $sqlQuery_run = DB::table('users')->where('id', $cd)->update($row_data);
        }else{
            $password = substr(str_shuffle(time()), 0, 6);
            $password = 'admin#240';
            $row_data['create_by'] = $userId;
            $row_data['created_at'] = $today;
            $row_data['user_type'] = 2;
            $row_data['actv_status'] = 1;
            $row_data['password'] = Hash::make($password);
            $emp_cd = $sqlQuery_run = DB::table('users')->insertGetId($row_data);
        }
        if($sqlQuery_run){
            if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event'){
                $findUser = DB::table('users')->where('id', $emp_cd)->first();
                $user_cpfno         = $findUser->cpf_no;
                $user_name          = $findUser->name;
                $user_email         = $findUser->email;
                $user_mobile        = $findUser->mobile;
                $user_level         = $findUser->level;
                $user_designation   = $findUser->designation;
                $user_category      = $findUser->category;
                $user_location      = $findUser->location;
                $row_dataE['user_name']         = $user_name;
                $row_dataE['user_cpfno']        = $user_cpfno;
                $row_dataE['user_email']        = $user_email;
                $row_dataE['user_mobile']       = $user_mobile;
                $row_dataE['user_level']        = $user_level;
                $row_dataE['user_designation']  = $user_designation;
                $row_dataE['user_category']     = $user_category;
                $row_dataE['user_location']     = $user_location;

                $row_dataE['event_book_id'] = 0;
                $row_dataE['emp_hotel_cd'] = $hotel_cd;
                $row_dataE['emp_hotel_cat_cd'] = $room_categorycd;
                $row_dataE['share_room_with_empcd'] = $share_room_with_empcd;
                $findAvt = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->first();
                $prv_emp_event_cd = @$findAvt->emp_event_cd;
                $prv_emp_hotel_cd = @$findAvt->emp_hotel_cd;
                $prv_emp_hotel_cat_cd = @$findAvt->emp_hotel_cat_cd;
                if(($eventcd != $prv_emp_event_cd || $hotel_cd != $prv_emp_hotel_cd) && $intcd > 0){
                    $queryTrfHtl = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->update(['status_in_htl' => 0]);
                    $findAvt = 0;
                }
                if ($findAvt) {
                        $shareRoomUpdt = $findAvt->share_room_with_empcd;
                        $row_dataE['updated_at']     = $today;
                        $subQueryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->update($row_dataE);
                }else{
                    $row_dataE['created_at']        = $today;
                    $row_dataE['emp_cd']            = $emp_cd;
                    $row_dataE['emp_event_cd']      = $eventcd;
                    $row_dataE['ev_emp_create_by']  = $userId;
                    $row_dataE['status_in_htl']     = 1;
                    $subQueryRun = DB::table('event_books_emp')->insert($row_dataE);
                }

                if($share_room_with > 0){ // if room sahre 
                    $share_room_with_empcdIdsAll = [];
                    $shareUserFind = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)->where('emp_cd', $share_room_with)->first();
                    if($shareUserFind){
                        $share_room_with_empcdIds = $shareUserFind->share_room_with_empcd;
                        if(!is_null($share_room_with_empcdIds) && !empty($share_room_with_empcdIds)){
                            $share_room_with_empcdIdsAll = explode(',', $share_room_with_empcdIds);
                        }
                    }
                    $share_room_with_empcdIdsAll[] = (int)$share_room_with;
                    $share_room_with_empcdIdsAll[] = (int)$emp_cd;
                    $uniqueShareEmpIds = array_unique($share_room_with_empcdIdsAll);
                    $uniqueShareEmpIds1 = implode(',', $uniqueShareEmpIds);
                    
                    $queryRun = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)->whereIn('emp_cd', $uniqueShareEmpIds)->update(['share_room_with_empcd' => $uniqueShareEmpIds1]);
                }
            }

            $dataMsg['status'] = 1;
            if($cd > 0){
                $dataMsg['message'] = "Update Successfully"; 
            }else{
                if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event'){
                    $mail = new EmailController();
                    $subject = "Login Details for an event.";
                    $content = "<p>Hello Dear <b>".$name."</b>,</p> <br><p>You have registred for a event. </p><br><p>Your event detalis are below : </p><p><b>CPF No. :</b> ".$cpf_no."<br><b>Login Username/Email :</b> ".$email."<br><b>Passwprd :</b>".$password."<p>";
                    $mail->sendMail($content, $subject, $email);
                }

                $dataMsg['message'] = "Insert Successfully"; 
            }
        }else{
            $dataMsg['status'] = 3;
            if($cd > 0){
                $dataMsg['message'] = "Not update Successfully";
            }else{
                $dataMsg['message'] = "Not insert Successfully"; 
            }
        }
        //////////////// start the code for calculate the room availablity ////////////////////////////////
        if(@$page_type == 'hotel' || @$page_type == 'driver' || @$page_type == 'event'){
            // SELECT COUNT(*) as ttl_emp,IF(share_room_with_empcd IS NOT NULL, 1, COUNT(*)) AS occupied_room, emp_event_cd, emp_hotel_cd, emp_hotel_cat_cd, share_room_with_empcd FROM `event_books_emp` WHERE `emp_event_cd` = 1 AND `emp_hotel_cd` = 1 AND `emp_hotel_cat_cd` = 2 AND `status_in_htl` = 1 GROUP BY `emp_hotel_cat_cd`, `share_room_with_empcd` ORDER BY `occupied_room` DESC, `emp_hotel_cat_cd` ASC

            $occupiedRoomsQuery = DB::table('event_books_emp')->selectRaw('IF(share_room_with_empcd IS NOT NULL, 1, COUNT(*)) AS occupied_room, emp_event_cd, emp_hotel_cd, emp_hotel_cat_cd, share_room_with_empcd')->where('emp_event_cd', $eventcd)
                                ->when($hotel_cd > 0, function ($query) use ($hotel_cd, $room_categorycd) {
                                    $query->where('emp_hotel_cd', $hotel_cd)
                                    ->when($room_categorycd > 0, function ($query) use ($room_categorycd) {
                                        $query->where('emp_hotel_cat_cd', $room_categorycd);
                                    });
                                })->where('status_in_htl', 1)
                                ->groupBy('emp_hotel_cat_cd', 'share_room_with_empcd', 'emp_event_cd', 'emp_hotel_cd')
                                ->orderByDesc('occupied_room')->orderBy('emp_hotel_cat_cd', 'asc')->get();
            if ($occupiedRoomsQuery->count() > 0) {
                foreach ($occupiedRoomsQuery as $key => $rowData) {
                    $hotel_cat_cd       = $rowData->emp_hotel_cat_cd;
                    $roomUpdtData['occupied_rooms'] = 0;
                    DB::table('hotels_category')->where('evv_id', $eventcd)->where('htl_cat_id', $hotel_cat_cd)->update($roomUpdtData);
                }
                foreach ($occupiedRoomsQuery as $key => $rowData) {
                    $occupied_room      = $rowData->occupied_room;
                    $hotel_cd           = $rowData->emp_hotel_cd;
                    $hotel_cat_cd       = $rowData->emp_hotel_cat_cd;

                    $roomUpdtData = [];
                    $roomUpdtData['occupied_rooms'] = DB::raw('occupied_rooms + '.$occupied_room);
                    $roomUpdtData['vacent_rooms'] = DB::raw('total_rooms - occupied_rooms');

                    DB::table('hotels_category')->where('evv_id', $eventcd)->where('htl_cat_id', $hotel_cat_cd)->update($roomUpdtData);
                }
            }
        }
        //////////////// end the code for calculate the room availablity ////////////////////////////////
        return redirect()->route('employee')->with('message', $dataMsg);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $inputData = $request->all();
        
        $validateData = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'mobile' => ['required', 'min:10'],
            'password' => ['required', 'min:2', 'confirmed']
        ]);  
        return redirect('/register')->with($msg);
    }
    public function destroy(Request $request)
    {
        $emp_cd = $del_id = $request->id;
        $event_id = $request->code;
        if($event_id > 0){
            $getQuery = DB::table('event_books_emp')->where('emp_cd', $del_id)->where('emp_ev_book_id', $event_id)->first();
            $share_room_with_empcd = $getQuery->share_room_with_empcd;
            $eventcd = $getQuery->emp_event_cd;
            if(!is_null($share_room_with_empcd)){
                $allEmpCds = $shareRoomUpdtAll = explode(',', $share_room_with_empcd);
            
                $shareRoomUpdtAll = array_diff($shareRoomUpdtAll, [$emp_cd]);
                $shareRoomUpdtAllCnt = count($shareRoomUpdtAll);
                if($shareRoomUpdtAllCnt > 1){
                    $shareEmpIdsRooms = implode(',', $shareRoomUpdtAll);
                }else{
                    $shareEmpIdsRooms = NULL;
                }
                
                $queryRun2 = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)->whereIn('emp_cd', $allEmpCds)->update(['share_room_with_empcd' => $shareEmpIdsRooms]);
            }
            $runQuery = DB::table('event_books_emp')->where('emp_cd', $del_id)->where('emp_ev_book_id', $event_id)->delete();
        }else{
            $runQuery = DB::table('users')->where('id', $del_id)->update(['actv_status' => 2]);
        }
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }
    
    public function logout(){
        Session::flush();
        Auth::logout();
        $msg = [
            'status' => 1, 
            'message' => 'Successfully logged out'
        ];
        return redirect('/')->with(['message' => $msg]);
    }
    public function hotelUpdate(Request $request)
    {
        //print_r($request->all()); die;
        $user = Auth()->user();
        $emp_code       = $request->cd;
        $emp_evv_id     = $request->emp_evv_id;
        $change_stataus = $request->change_stataus;
        if($change_stataus == 4){
            $drvr_number        = $request->drvr_number;
            $vehicle_details    = $request->vehicle_details;
            $drvr_name          = NULL;

            $dataUpdate = [];
            $dataUpdate['drvr_name']        = $drvr_name;
            $dataUpdate['drvr_number']      = $drvr_number;
            $dataUpdate['drvr_veh_details'] = $vehicle_details;
            $dataUpdate['flight_status']    = 0;
            $queryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_evv_id)->where('emp_cd', $emp_code)->update($dataUpdate);
            if($queryRun){
                $message = ['status' => 1, 'message' => "Update successfully."];
            }else{
                $message = ['status' => 3, 'message' => "Not update."]; 
            }
        }else{
            $remarks    = $request->remarks;
            $dataUpdate = [];
            $dataUpdate['admin_remarks']  = $remarks;
            $dataUpdate['req_chng_status']  = $change_stataus;
            $today = date('Y-m-d H:i:s');

            if($change_stataus == 2){
                $dataUpdate['status_in_htl']  = 0;
                $dataUpdate['updated_at']  = $today;
            }

            $queryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_evv_id)->where('emp_cd', $emp_code)->update($dataUpdate);
            if($queryRun){
                if($change_stataus == 2){
                    $queryGet = DB::table('event_books_emp')->where('emp_ev_book_id', $emp_evv_id)->where('emp_cd', $emp_code)->first();
                    $newData = [];
                    $newData['event_book_id'] = 0;
                    $newData['emp_cd'] = $emp_code;
                    $newData['emp_event_cd'] = $queryGet->emp_event_cd;
                    $newData['emp_hotel_cd'] = $queryGet->req_chng_hotel_cd;
                    $newData['emp_hotel_cat_cd'] = $queryGet->req_chng_hotel_cat_cd;
                    $newData['arv_flight_name'] = $queryGet->arv_flight_name;
                    $newData['arv_flight_no'] = $queryGet->arv_flight_no;
                    $newData['arv_date_time'] = $queryGet->arv_date_time;
                    $newData['arv_location'] = $queryGet->arv_location;
                    $newData['dptr_flight_name'] = $queryGet->dptr_flight_name;
                    $newData['dptr_flight_no'] = $queryGet->dptr_flight_no;
                    $newData['dptr_date_time'] = $queryGet->dptr_date_time;
                    $newData['dptr_location'] = $queryGet->dptr_location;
                    $newData['flight_status'] = $queryGet->flight_status;
                    $newData['drvr_name'] = $queryGet->drvr_name;
                    $newData['drvr_number'] = $queryGet->drvr_number;
                    $newData['drvr_veh_details'] = $queryGet->drvr_veh_details;
                    $newData['ev_emp_create_by'] = $user->id;
                    $newData['created_at'] = $today;
                    $queryInsert = DB::table('event_books_emp')->insert($newData);
                }
                $message = ['status' => 1, 'message' => "Update successfully."];
            }else{
                $message = ['status' => 3, 'message' => "Not update."]; 
            }
            //return redirect()->back()->with('message', $message);
        }
        return redirect('employee')->with('message', $message);
    }
}
