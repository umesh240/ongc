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

use App\Http\Controllers\EmailController;

class ImportController extends Controller
{
    public function eventBooking()
    {
        $event_list = DB::table('events')->where('actv_event', 1)->get();
        $data['event_list'] = $event_list;
        $data['showlist'] = 0; 
        return view('import_event', $data);
    }
    public function importEventBookExcel(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|max:2048', // Adjust the validation rules as needed
        ]);
        /// 'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048', 
        // Check file extension manually
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, ['csv', 'xls', 'xlsx'])) {
                $validator->errors()->add('excel_file', 'The excel file must be a file of type: csv, xlsx, xls');
            }
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $event_list = DB::table('events')->where('actv_event', 1)->get();
        $data['event_list'] = $event_list;
        $eventcd = $request->eventcd;
        $event_info = DB::table('events')->where('actv_event', 1)->where('ev_id', $eventcd)->first();
        $data['eventcd'] = $eventcd; 
        $data['event_info'] = $event_info; 
        try {
            $invalidRows = $excelRows = [];
            $file = $request->file('excel_file');

            // Define your custom validation logic here
            $excelData = Excel::toArray([], $file)[0]; // Load Excel data into an array
            
            // Perform custom validation on $excelData
            foreach ($excelData as $key => $row) {
                // Perform validation on each row
                $lastRow = count($row);
                if($key > 0){
                    
                    //echo '<pre>'; print_r($row);
                    $sno                = $row[0];
                    $cpfno              = $row[1];
                    $name               = $row[2];
                    $level              = $row[3];
                    $desination         = $row[4];
                    $email              = trim($row[5]);
                    $mobile             = $row[6];
                    $location           = $row[7];
                    $category           = $row[8];
                    $from_dt            = $row[9];
                    $to_dt              = $row[10];
                    $hotel_nm           = $row[11];
                    $category_room      = $row[12];
                    $comments           = $row[13];

                    $arrival_airport    = $row[14];
                    $arrival_airline    = $row[15];
                    $arrival_dt         = $row[16];
                    $arrival_tm         = $row[17];
                    $arrival_flightno   = $row[18];

                    $depart_airport     = $row[19];
                    $depart_airline     = $row[20];
                    $depart_dt          = $row[21];
                    $depart_tm          = $row[22];
                    $depart_flightno    = $row[23];

                    $transport_service  = $row[24];
                    $travelling_details = $row[25];

                    
                    if(empty($cpfno)){
                        $cpfno = $mobile;
                    }
                    $isEmail = str_contains($email, '@');
                    if((empty(trim($email)) || !$isEmail) && (empty(trim($mobile)) || empty(trim($cpfno)) )){
                        $row[26] = 4;
                        $row[27] = "end_of_line";
                        $invalidRows[] = $row;

                    }else{
                        $result = DB::table('event_books_emp')
                                        ->leftJoin('users', 'users.id', '=', 'event_books_emp.emp_cd')
                                        ->where('event_books_emp.emp_event_cd', $eventcd)
                                        ->where('users.email', $email)
                                        ->first();
                        $cpf_noEMP = @$result->cpf_no;
                        $resultCnt = @$result->id;
                        $emp_booking_exist = 0;
                        if($resultCnt > 0){
                            $emp_booking_exist = 1;
                            if(strtoupper($cpf_noEMP) != strtoupper($cpfno)){
                                //$emp_booking_exist = 2;
                            }
                        }
                        $row[26] = $emp_booking_exist;
                        $row[27] = "end_of_line";
                        $excelRows[] = $row;
                        //$excelRows[] = trim($row,",");
                    }
                }
            }
            $data['invalidRows'] = $invalidRows;
            $data['excelRows'] = $excelRows; 
            $data['showlist'] = 1; 

            //////////////// start the code for calculate the room availablity ////////////////////////////////
            if(1){
                // SELECT COUNT(*) as ttl_emp,IF(share_room_with_empcd IS NOT NULL, 1, COUNT(*)) AS occupied_room, emp_event_cd, emp_hotel_cd, emp_hotel_cat_cd, share_room_with_empcd FROM `event_books_emp` WHERE `emp_event_cd` = 1 AND `emp_hotel_cd` = 1 AND `emp_hotel_cat_cd` = 2 AND `status_in_htl` = 1 GROUP BY `emp_hotel_cat_cd`, `share_room_with_empcd` ORDER BY `occupied_room` DESC, `emp_hotel_cat_cd` ASC

                $occupiedRoomsQuery = DB::table('event_books_emp')->selectRaw('COUNT(*) AS ttl_emp, IF(share_room_with_empcd IS NOT NULL, 1, COUNT(*)) AS occupied_room, emp_event_cd, emp_hotel_cd, emp_hotel_cat_cd, share_room_with_empcd')->where('emp_event_cd', $eventcd)->where('status_in_htl', 1)
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
            return view('import_event', $data);

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->failures())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing Excel data: ' . $e->getMessage());
        }
    }
    ////////////////////    save execl   /////////////////////////////////////////
    public function importEventBookSave(Request $request)
    {
        //print_r($request->all());
        $info = $request->info;
        $event_id = $request->bok_ev_id;
        //echo $info."<br>";
        $row = explode(',', $info);

        //echo '<pre>'; print_r($row);
        $sno                = $row[0];
        $cpfno              = $row[1];
        $name               = ucwords(trim($row[2]));
        $level              = ucwords(trim($row[3]));
        $designation        = ucwords(trim($row[4]));
        $email              = trim($row[5]);
        $mobile             = $row[6];
        $location           = ucwords(trim($row[7]));
        $category           = ucwords(trim($row[8]));
        $from_dt            = $row[9];
        $to_dt              = $row[10];
        $hotel_nm           = ucwords(trim($row[11]));
        $category_room      = ucwords(trim($row[12]));
        $share_room_info    = trim($row[13]);

        $arrival_airport    = trim($row[14]);
        $arrival_airline    = trim($row[15]);
        $arrival_dt         = trim($row[16]);
        $arrival_tm         = trim($row[17]);
        $arrival_flightno   = trim($row[18]);

        $depart_airport     = trim($row[19]);
        $depart_airline     = trim($row[20]);
        $depart_dt          = trim($row[21]);
        $depart_tm          = trim($row[22]);
        $depart_flightno    = trim($row[23]);

        $transport_service  = trim($row[24]);
        $travelling_details = trim($row[25]);
        /*
        $arrival_dt         = $row[14];
        $arrival_tm         = $row[15];
        $arrival_flightno   = $row[16];
        $depart_dt          = $row[17];
        $depart_tm          = $row[18];
        $depart_flightno    = $row[19];
        $vehile_details     = $row[20];
        $driver_no          = $row[21];
        */
        $row_status         = $row[26];

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $password = '';
        $userFind = DB::table('users')->where('email', $email)->first();
        if ($userFind) {
            $emp_id = $userFind->id;
        } else {
            $row_data = [];
            $row_data['name'] = ucwords(@$name);
            $row_data['cpf_no'] = @$cpfno;
            $row_data['email'] = @$email;
            $row_data['mobile'] = @$mobile;
            $row_data['level'] = ucwords(@$level);
            $row_data['designation'] = ucwords(@$designation);
            $row_data['category'] = ucwords(@$category);
            $row_data['location'] = ucwords(@$location);
            $row_data['create_by'] = $userId;
            $row_data['created_at'] = $today;
            $row_data['user_type'] = 2;
            $row_data['actv_status'] = 1;
            $password = substr(str_shuffle(time()), 0, 6);
            $password = 'admin#240';
            $row_data['password'] = Hash::make($password);
            $emp_id = DB::table('users')->insertGetId($row_data);
        }
        $hotelFind = DB::table('hotels')->where('hotel_name', $hotel_nm)->first();
        if ($hotelFind) {
            $htl_id = $hotelFind->htl_id;
        } else {
            $rowH_data = [];
            $rowH_data['hotel_name'] = $hotel_nm;
            $rowH_data['hotel_address'] = '';
            $rowH_data['hotel_geolocation'] = '';
            $rowH_data['evv_id'] = $event_id;
            $rowH_data['hotel_image'] = NULL;
            $rowH_data['create_by'] = $userId;
            $rowH_data['created_at'] = $today;
            $htl_id = DB::table('hotels')->insertGetId($rowH_data);
        }
        $hotelCateFind = DB::table('hotels_category')->where('htl_idd', $htl_id)->where('hotel_category', $category_room)->first();
        if ($hotelCateFind) {
            $htl_cat_id = $hotelCateFind->htl_cat_id;
        } else {
            $no_of_rooms = 1;
            $categoryData = [];
            $categoryData['hotel_category']     = ucwords(@$category_room);
            $categoryData['hotel_nm']           = ucwords($hotel_nm);
            $categoryData['total_rooms']        = $no_of_rooms;
            $categoryData['create_by']          = $userId;
            $categoryData['htl_idd']            = $htl_id;
            $categoryData['created_at']         = $today;
            $categoryData['occupied_rooms']     = $no_of_rooms;
            $categoryData['vacent_rooms']       = $no_of_rooms;
            $categoryData['evv_id']             = $event_id;
            $htl_cat_id = DB::table('hotels_category')->insertGetId($categoryData);
        }
        $arrv_dt = $dept_dt = NULL;
        if(!empty(trim($arrival_dt))){
            $arrival_dtAll = explode('-', $arrival_dt);
            $arrv_dt = $arrival_dtAll[2].'-'.sprintf("%02d", $arrival_dtAll[1]).'-'.sprintf("%02d", $arrival_dtAll[0]);
            $arrv_dt = date($arrv_dt.' '.$arrival_tm);
            //$arrv_dt = date('Y-m-d H:i:s', strtotime($arrv_dt));
        }
        if(!empty(trim($depart_dt))){
            $depart_dtAll = explode('-', $depart_dt);
            $dept_dt = $depart_dtAll[2].'-'.sprintf("%02d", $depart_dtAll[1]).'-'.sprintf("%02d", $depart_dtAll[0]);
            $dept_dt = date($dept_dt.' '.$depart_tm); 
            //$dept_dt = date('Y-m-d H:i:s', strtotime($dept_dt));

        }
        $flight_status = 0;
        if(!empty(trim($arrival_flightno))){
            $flight_status = 1;
        }
        if(!empty(trim($depart_flightno))){
            $flight_status = 1;
        }
        $share_room_with = 0;
        if(!empty(trim($share_room_info))){
            $shareUserFind = DB::table('users')->where('cpf_no', $share_room_info)->first();
            if($shareUserFind){
                $share_room_with = $shareUserFind->id;
            }
        }
        $row_data = [];   /// book event
        $row_data['user_name']              = $name;
        $row_data['user_cpfno']             = $cpfno;
        $row_data['user_email']             = $email;
        $row_data['user_mobile']            = $mobile;
        $row_data['user_level']             = $level;
        $row_data['user_designation']       = $designation;
        $row_data['user_category']          = $category;
        $row_data['user_location']          = $location;

        $row_data['emp_hotel_cd']           = $htl_id;
        $row_data['emp_hotel_cat_cd']       = $htl_cat_id;
        $row_data['arv_flight_no']          = $arrival_flightno;
        $row_data['arv_date_time']          = $arrv_dt;
        $row_data['arv_location']           = $arrival_airport;
        $row_data['arv_flight_name']        = $arrival_airline;
        $row_data['dptr_flight_no']         = $depart_flightno;
        $row_data['dptr_date_time']         = $dept_dt;
        $row_data['dptr_location']          = $depart_airport;
        $row_data['dptr_flight_name']       = $depart_airline;
        $row_data['flight_status']          = $flight_status;
        $row_data['flight_create_date']     = $today;
        $row_data['drvr_name']              = '';
        $row_data['drvr_number']            = $travelling_details;
        $row_data['drvr_veh_details']       = $transport_service;
        $row_data['share_room_with_empcd']  = $share_room_with;
        $row_data['created_at']             = $today;
        $row_data['updated_at']             = $today;
        $dataMsg = [];
        $findAvt = DB::table('event_books_emp')->where('emp_event_cd', $event_id)->where('emp_cd', $emp_id)
                    ->where('status_in_htl', 1)->first(); // check active emp's event
        $intcd = @$findAvt->emp_ev_book_id;
        if($intcd <= 0 || $intcd == null){ /// if not active event
            $findAvt = DB::table('event_books_emp')->where('emp_event_cd', $event_id)->where('emp_cd', $emp_id)
                    ->where('emp_hotel_cd', $htl_id)->where('status_in_htl', 0)->first();
                    /// find deactive event with same(imported hotel) hotel
        }

        $prv_emp_event_cd = @$findAvt->emp_event_cd;
        $prv_emp_hotel_cd = @$findAvt->emp_hotel_cd;
        $prv_emp_hotel_cat_cd = @$findAvt->emp_hotel_cat_cd;
        if(($event_id != $prv_emp_event_cd || $htl_cat_id != $prv_emp_hotel_cd) && $intcd > 0){
            $queryTrfHtl = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $event_id)->where('emp_cd', $emp_id)->update(['status_in_htl' => 0, 'updated_at' => $today]);
            $findAvt = 0;
        }
        $new_insert = 0;
        if ($intcd > 0) {
            //$row_data['updated_at']     = $today;
            $subQueryRun = DB::table('event_books_emp')->where('emp_ev_book_id', $intcd)->where('emp_event_cd', $event_id)->where('emp_cd', $emp_id)->update($row_data);
            
            if($subQueryRun){
                $dataMsg['message'] = "Success"; 
                $dataMsg['status'] = 1;
            }else{
                $dataMsg['message'] = "Failed"; 
                $dataMsg['status'] = 0;
            }
        }else{
            $row_data['event_book_id']      = 0;
            //$row_data['created_at']         = $today;
            $row_data['emp_cd']             = $emp_id;
            $row_data['emp_event_cd']       = $event_id;
            $row_data['ev_emp_create_by']   = $userId;
            $subQueryRun = DB::table('event_books_emp')->insert($row_data);

            if($subQueryRun){
                $dataMsg['message'] = "Success"; 
                $dataMsg['status']  = 1;
                $new_insert = 1;
            }else{
                $dataMsg['message'] = "Failed"; 
                $dataMsg['status']  = 0;
            }
        }
        if($share_room_with > 0){ // if room share 
            $share_room_with_empcdIdsAll = [];
            $shareUserFind = DB::table('event_books_emp')->where('emp_event_cd', $event_id)->where('emp_cd', $share_room_with)->first();
            if($shareUserFind){
                $share_room_with_empcdIds = $shareUserFind->share_room_with_empcd;
                if(!is_null($share_room_with_empcdIds) && !empty($share_room_with_empcdIds)){
                    $share_room_with_empcdIdsAll = explode(',', $share_room_with_empcdIds);
                }
            }
            $share_room_with_empcdIdsAll[] = (int)$share_room_with;
            $share_room_with_empcdIdsAll[] = (int)$emp_id;
            $uniqueShareEmpIds             = array_unique($share_room_with_empcdIdsAll);
            $uniqueShareEmpIds1            = implode(',', $uniqueShareEmpIds);
            
            $queryRun = DB::table('event_books_emp')->where('emp_event_cd', $event_id)->whereIn('emp_cd', $uniqueShareEmpIds)->update(['share_room_with_empcd' => $uniqueShareEmpIds1]);
        }
        if($new_insert === 1){
            $mail = new EmailController();
            $subject = "Login Details for an event.";
            $content = "<p>Hello Dear <b>".$name."</b>,</p> <br><p>You have registred for a event. </p><br><p>Your event detalis are below : </p><p><b>CPF No. :</b> ".$cpfno."<br><b>Login Username/Email :</b> ".$email."<br><b>Passwprd :</b>".$password."<p>";
            $email = 'umesh.codeinit@gmail.com';
            $mail->sendMail($content, $subject, $email);
        }
        return response()->json($dataMsg);
    }
}
