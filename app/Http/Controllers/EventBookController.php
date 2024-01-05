<?php

namespace App\Http\Controllers;

use App\Models\EventBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\Functions;
use Illuminate\Support\Facades\Http;

class EventBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $length = request('length', null); // Default to null if not provided
        $search = request('search', null); // Default to null if not provided
        $event_code = request('event_code', null);

        if(empty($length)){
            $length = 10;
        }
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        $bookevents_list = DB::table('event_books_emp')
                    ->leftJoin('users', 'event_books_emp.emp_cd', '=', 'users.id')
                    ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                    ->leftJoin('hotels_category', 'event_books_emp.emp_hotel_cat_cd', '=', 'hotels_category.htl_cat_id')
                    ->when($search != '', function ($query) use ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->where('users.name', 'like', '%'.$search.'%')
                            ->orWhere('users.cpf_no', 'like', '%'.$search.'%');
                        });
                    })
                    ->when($event_code > 0, function ($query) use ($event_code) {
                        $query->where('event_books_emp.emp_event_cd', '=', $event_code);
                    })->where('users.user_type', 2)->paginate($length);

        $events_list = DB::table('event_books_emp')->select('event_books_emp.emp_event_cd', 'events.*')
                    ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                    ->distinct()->get();
        $data['events_list'] = $events_list;            
        $data['bookevents_list'] = $bookevents_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        $data['event_code'] = $event_code;
        return view('bookevent', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    public function getHotelList(Request $request)
    {
        $eventcd = $request->eventcd;
        $user_cd = $request->user_cd;
        
        $user_exist = DB::table('event_books_emp')->where('status_in_htl', 1)->where('emp_cd', $user_cd)->where('emp_event_cd', $eventcd)->exists();

        $hotels_category = DB::table('hotels')->where('actv_hotel', 1)->where('evv_id', $eventcd)->get();
        $opts = '';
        if(count($hotels_category) > 1){
            $opts .= '<option value="">Select hotel</option>';
        }
        foreach ($hotels_category as $key => $category) {
            $htl_id = $category->htl_id;
            $hotel_name = $category->hotel_name;
            $hotel_address = $category->hotel_address;
            $opts .= '<option value="'.$htl_id.'" data-hotel_address="'.$hotel_address.'">'.$hotel_name.'</option>';
        }

        return response()->json(['hotel_list' => $opts, 'user_exist' => $user_exist]);
    }
    /**
     * Display the specified resource.
     */
    public function show($ae, $id=0)
    {
        $event_list = DB::table('events')->where('actv_event', 1)->get();
        $hotel_list = DB::table('hotels')->where('actv_hotel', 1)->get();
        $employee_list = DB::table('users')->where('actv_status', 1)->where('user_type', 1)->orWhere('user_type', 2)->get();
        $data['event_list'] = $event_list;
        $data['hotel_list'] = $hotel_list;
        $data['employee_list'] = $employee_list;
        if($id > 0){
            //$event_emp_info = DB::table('event_books_emp')->where('emp_ev_book_id', $id)->first();
            $event_emp_info = DB::table('event_books_emp')
                    ->select('event_books_emp.*', 'emp.id as ed_emp_id', 'emp.name as ed_emp_name', 'emp.level', 'emp.designation', 'emp.cpf_no as ed_emp_cpf_no', 'emp_share.id as ed_emp_share_id', 'emp_share.name as ed_emp_share_name', 'emp_share.cpf_no as ed_emp_share_cpf_no')
                    ->leftJoin('users as emp', 'event_books_emp.emp_cd', '=', 'emp.id')
                    ->leftJoin('users as emp_share', 'event_books_emp.share_room_with_empcd', '=', 'emp_share.id')
                    ->where('emp_ev_book_id', $id)
                    ->first();
            $data['event_emp_info'] = $event_emp_info;

            //$chng_hotel_cd = $event_emp_info->req_chng_hotel_cd;
            //$chng_hotel_cd = $event_emp_info->req_chng_hotel_cd;
            if($ae == 'hotel'){
                /*
                $event_emp_info = DB::table('event_books_emp')
                    ->select('event_books_emp.emp_ev_book_id', 'emp.id as ed_emp_id', 'emp.name as ed_emp_name', 'emp.level', 'emp.designation', 'emp.cpf_no as ed_emp_cpf_no', 'emp_share.id as ed_emp_share_id', 'emp_share.name as ed_emp_share_name', 'emp_share.cpf_no as ed_emp_share_cpf_no')
                    ->leftJoin('hotels', 'event_books_emp.req_chng_hotel_cd', '=', 'hotels.htl_id')
                    ->leftJoin('hotels_category', 'event_books_emp.req_chng_hotel_cat_cd', '=', 'hotels_category.htl_cat_id')*/
            }
        }
        $data['page_type'] = $ae;
        return view('bookeventae', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventBook $eventBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //print_r($request->all());
        $cd = $request->cd;
        $user_info = @$request->user_info;
        $validateData = Validator::make($request->all(), [
            'eventcd' => ['required'],
            'hotel_cd' => ['required'],
            'room_categorycd' => ['required']
        ], [
            'eventcd.required' => 'Event is required field.',
            'hotel_cd.required' => 'Hotel is required field.',
            'room_categorycd.required' => 'Room category is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        $user_infoCnt = 0;
        if(!empty($user_info)){
            $user_infoCnt = @count($user_info); 
        }
        if($user_infoCnt <= 0){
            return response()->json(['msg_type' => 3, 'msg' => 'Employee not added. <br>Please add alteas 1 employee.', 'idd' => 0]);
        }
        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');

        $eventcd = $request->eventcd;
        $hotel_cd = $request->hotel_cd;
        $room_categorycd = $request->room_categorycd;
        $user_infoAll = implode('||', $user_info);

        $user_idss = [];
        foreach ($user_info as $key => $record) {
            $itemArr = explode('^', $record);
            $emp_cd = $itemArr[1];
            $user_idss[] = $emp_cd;
        }
        $user_idss = implode(',', $user_idss);
        
        $row_dataM = [];
        $row_dataM['event_cd'] = $eventcd;
        $row_dataM['hotel_cd'] = $hotel_cd;
        $row_dataM['hotel_cat_cd'] = @$room_categorycd;
        $row_dataM['employee_cds'] = @$user_idss;
        $row_dataM['employee_cds_info'] = @$user_infoAll;

        $row_id = 0;
        if($cd > 0){
            $row_dataM['updated_at'] = $today;
            $query_run = DB::table('event_books')->where('ev_book_id', $cd)->update($row_dataM);
            $row_id = $cd;
        }else{
            $row_dataM['ev_create_by'] = $userId;
            $row_dataM['created_at'] = $today;
            $row_id = $query_run = DB::table('event_books')->insertGetId($row_dataM);
        }

        if($query_run){
            foreach ($user_info as $key => $record) {
                $itemArr = explode('^', $record);

                $intcd = $itemArr[0];
                $emp_cd = $itemArr[1];
                $share_room_with = $itemArr[2];

                $row_data = [];
                $row_data['emp_hotel_cd'] = $hotel_cd;
                $row_data['emp_hotel_cat_cd'] = $room_categorycd;
                $row_data['share_room_with_empcd'] = $share_room_with;
                
                $findAvt = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->first();
                if ($findAvt) {
                    $shareRoomUpdt = $findAvt->share_room_with_empcd;
                    $row_data['updated_at']     = $today;
                    $subQueryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->update($row_data);
                    if(!is_null($shareRoomUpdt) && !empty($shareRoomUpdt)){
                        $shareRoomUpdtAll = explode(',', $shareRoomUpdt);
                        $keyAr = array_search($emp_cd, $shareRoomUpdtAll); // to remove shared room
                        if ($keyAr !== false) {
                            unset($shareRoomUpdtAll[$key]);
                        }
                        $shareRoomUpdtAllCnt = count($shareRoomUpdtAll);
                        if($shareRoomUpdtAllCnt > 1){
                            $shareEmpIdsRooms = implode(',', $shareRoomUpdtAll);
                        }else{
                            $shareEmpIdsRooms = NULL;
                        }
                        $queryRun1 = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)->where('emp_cd', $emp_cd)->update(['share_room_with_empcd' => NULL]);
                        $queryRun2 = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)->whereIn('emp_cd', $shareRoomUpdtAll)->update(['share_room_with_empcd' => $shareEmpIdsRooms]);
                    }
                }else{
                    $row_data['event_book_id']  = $row_id;
                    $row_data['created_at']     = $today;
                    $row_data['emp_cd']         = $emp_cd;
                    $row_data['emp_event_cd']   = $eventcd;
                    $row_data['ev_emp_create_by'] = $userId;
                    $subQueryRun = DB::table('event_books_emp')->insert($row_data);
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
                $dataMsg['message'] = "Insert Successfully"; 
            }
        }else{
            $dataMsg['status'] = 3;
            if($cd > 0){
                $dataMsg['message'] = "Not update successfully";
            }else{
                $dataMsg['message'] = "Not insert successfully"; 
            }
        }
        return response()->json($dataMsg);
    }

    public function destroy(Request $request)
    {
        $del_id = $request->id;
        $runQuery = DB::table('event_books_emp')->where('emp_ev_book_id', $del_id)->delete();
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function getEventEmployee(Request $request)
    {
        //print_r($request->all());
        $hotel_cd = $request->hotel_cd;
        $eventcd = $request->eventcd;
        $categorycd = $request->categorycd;
        $queryRun = DB::table('event_books_emp')
                    ->leftJoin('users', 'event_books_emp.emp_cd', '=', 'users.id')
                    ->where('event_books_emp.emp_event_cd', $eventcd)
                    ->where('event_books_emp.emp_hotel_cd', $hotel_cd)
                    ->where('event_books_emp.emp_hotel_cat_cd', $categorycd)->get();
        $opts = '';
        if (!empty($queryRun)) {
            $queryRunCnt = count($queryRun);
            if($queryRunCnt > 0){
                $opts .= '<option value="">Select employee</option>';
                foreach ($queryRun as $key => $emp) {
                    $opts .= '<option data-level="'.$emp->level.'" data-desi="'.$emp->designation.'" data-cate="'.$emp->category.'" value="'.$emp->id.'">'.$emp->cpf_no.' - '.$emp->name.'</option>';
                    
                }
                $status = 1;
            }else{
                $opts .= '<option value="">No Record Found</option>';
                $status = 0;
            }
        }else{
            $opts .= '<option value="">No Record Found</option>';
            $status = 0;
        }
        return response()->json(['result' => $opts, 'status' => $status]);
    }
    public function ckExistEmpEvent(Request $request)
    {
        //print_r($request->all());
        $intno = $request->intno;
        $empId = $request->empId;
        $eventcd = $request->eventcd;
        $queryExist = DB::table('event_books_emp')->where('emp_event_cd', $eventcd)
                    ->where('emp_cd', $empId)->where('emp_ev_book_id', '<>', $intno)->exists();
        if($queryExist){
            $result = "This user already exist for the selected event.";
            $status = 0;
        }else{
            $result = "User not found. We can add it.";
            $status = 1;
        }
        return response()->json(['result' => $result, 'status' => $status]);
    }


    public function getNotification()
    {
        $data = [];
        $hotelNotifications = DB::table('event_books_emp')
                    ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                    ->leftJoin('users', 'event_books_emp.emp_cd', '=', 'users.id')
                    ->where('event_books_emp.req_chng_status', 1)->where('event_books_emp.status_in_htl', 1)
                    ->where('events.actv_event', 1)
                    ->select('event_books_emp.emp_ev_book_id', 'event_books_emp.emp_cd', 'event_books_emp.req_chng_status as new_update', 'event_books_emp.req_chng_date as createDate', 'users.name', DB::raw('"hotel" as notification_type'), 'events.event_name');
        $flightNotifications = DB::table('event_books_emp')
                    ->leftJoin('events', 'event_books_emp.emp_event_cd', '=', 'events.ev_id')
                    ->leftJoin('users', 'event_books_emp.emp_cd', '=', 'users.id')
                    ->where('event_books_emp.flight_status', 2)->where('event_books_emp.status_in_htl', 1)
                    ->where('events.actv_event', 1)
                    ->select('event_books_emp.emp_ev_book_id', 'event_books_emp.emp_cd', 'event_books_emp.flight_status as new_update', 'event_books_emp.flight_create_date as createDate', 'users.name', DB::raw('"flight" as notification_type'), 'events.event_name');
        $notification_list = $hotelNotifications->union($flightNotifications)->orderBy('createDate', 'desc')->get();

        $notification_listCnt = count($notification_list);
        $data['notification_list'] = $notification_list;
        $data['notification_cnt'] = $notification_listCnt;
        return view('notification', $data);
    }
}
