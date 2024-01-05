<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $length     = request('length', null); // Default to null if not provided
        $search     = request('search', null); // Default to null if not provided
        $event_code = request('event_code', null);
        if(empty($length)){
            $length = 10;
        }
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        $hotel_list = DB::table('hotels')
                    ->leftJoin('events', 'hotels.evv_id', '=', 'events.ev_id')
                    ->leftJoin('hotels_category', 'hotels.htl_id', '=', 'hotels_category.htl_idd')
                    ->select('hotels.*', DB::raw('(SELECT COUNT(*) FROM hotels_category WHERE hotels.htl_id = hotels_category.htl_idd And hotels_category.soft_delete_yn = 0) AS category_count'), DB::raw('(SELECT SUM(hotels_category.total_rooms) FROM hotels_category WHERE hotels.htl_id = hotels_category.htl_idd And hotels_category.soft_delete_yn = 0) AS rooms_count'), 'events.event_name', 'events.actv_event')
                    ->where(function ($query) use ($search) {
                        $query->where('hotels.hotel_name', 'like', '%'.$search.'%')
                        ->orWhere('hotels.hotel_address', 'like', '%'.$search.'%');
                    })->where('hotels_category.soft_delete_yn', 0)
                    ->when($event_code > 0, function ($query) use ($event_code) {
                        $query->where('hotels.evv_id', $event_code)->where('hotels.actv_hotel', 1);
                    })->groupBy('hotels.htl_id')->orderBy('events.event_name')->paginate($length);

        // $events_list = DB::table('events')->where('actv_event', 1)->get();
        $events_list = DB::table('hotels')->select('hotels.evv_id as emp_event_cd', 'events.*')
                    ->leftJoin('events', 'hotels.evv_id', '=', 'events.ev_id')->where('events.actv_event', 1)
                    ->distinct()->get();
        $data['events_list'] = $events_list;  
        $data['event_code'] = $event_code;
        $data['hotel_list'] = $hotel_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        return view('hotel', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($ae, $id = 0)
    {
        $data = [];
        $evv_id = 0;
        if($id > 0){
            $hotel = DB::table('hotels')->where('htl_id', $id)->first();
            $evv_id = $hotel->evv_id;
            $category = DB::table('hotels_category')->where('soft_delete_yn', 0)->where('htl_idd', $id)->get();
            $data['hotel'] = $hotel;
            $data['category'] = $category;
        }
        $event_list = DB::table('events')->where('actv_event', 1)
                        ->when($evv_id > 0, function ($query) use ($evv_id) {
                            $query->orWhere('ev_id', $evv_id);
                        })->get();
        $data['event_list'] = $event_list;
        $user_list = DB::table('users')->where('user_type', 2)->where('actv_status', 1)->get();
        $data['user_list'] = $user_list;
        return view('hotelae', $data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $prv_cd = $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'eventcd' => ['required'],
            'hotel_name' => ['required'],
            'hotel_address' => ['required']
        ], [
            'hotel_name.required' => 'Hotel name is required field.',
            'hotel_address.required' => 'Hotel address is required field.',
            'eventcd.required' => 'Event name is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        $category_infoCnt = 0;
        $category_info = @$request->category_info;
        if(!empty($category_info)){
            $category_infoCnt = @count($category_info); 
        }
        if($category_infoCnt <= 0){
            return response()->json(['msg_type' => 3, 'msg' => 'Category not add. <br>Please add alteas 1 Category.', 'idd' => 0]);
        }

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $row_data = [];
        $logistic_fpr    = @$request->logistic_fpr;
        $hospitality_fpr = @$request->hospitality_fpr;
        $eventcd         = @$request->eventcd;
        $hotel_name      = $request->hotel_name;
        $hotel_nameString               = str_replace(' ', '', $hotel_name);
        $row_data['hotel_name']         = ucwords($hotel_name);
        $row_data['hotel_address']      = ucwords(@$request->hotel_address);
        $row_data['hotel_geolocation']  = @$request->hotel_geolocation;
        $row_data['evv_id']             = @$eventcd;
        $row_data['distance']           = @$request->distance;
        $row_data['minutes']            = @$request->minutes;

        if($logistic_fpr > 0){
            $user_fpr = DB::table('users')->where('id', $logistic_fpr)->first();
            $row_data['logistic_fpr']   = @$logistic_fpr;
            $row_data['fpr_name']       = @$user_fpr->name;
            $row_data['fpr_mob_no']     = @$user_fpr->mobile;
        }else{
            $row_data['fpr_name'] = $row_data['fpr_mob_no'] = '';
            $row_data['logistic_fpr'] = 0; 
        }

        if($hospitality_fpr > 0){
            $user_fpr = DB::table('users')->where('id', $hospitality_fpr)->first();
            $row_data['hospitality_fpr']    = @$hospitality_fpr;
            $row_data['hosp_fpr_name']      = @$user_fpr->name;
            $row_data['hosp_fpr_mob_no']    = @$user_fpr->mobile;
        }else{
            $row_data['hosp_fpr_name'] = $row_data['hosp_fpr_mob_no'] = '';
            $row_data['hospitality_fpr'] = 0;
        }

        $directory = storage_path('app/hotel_image');
        $uploadedImages = $remains_Photo = $deleted_Imgs = $saved_hotel_imageAll = [];
        if($cd > 0){
            $getHtl = DB::table('hotels')->where('htl_id', $cd)->first();
            $saved_hotel_image = $getHtl->hotel_image;
            if(trim(@$saved_hotel_image) != ''){
                $saved_hotel_imageAll = explode('||', $saved_hotel_image);
            }

            if ($request->has('delImg')) {
                $deleted_Imgs = $request->delImg;
                foreach ($deleted_Imgs as $del_img) {
                    //Storage::delete('/app/hotel_image' . $del_img);
                    File::delete($directory.'/'.$del_img);
                }
            }

            //if(!empty($saved_hotel_imageAll) && !empty($deleted_Imgs)){}
            $remains_Photo = array_diff($saved_hotel_imageAll, $deleted_Imgs);
        }
        
        if ($request->hasFile('hotel_image')) {
            $image = @$request->file('hotel_image');
            if(!is_dir($directory)){    mkdir($directory);    }
            $files = File::glob($directory . '/htl_'.$hotel_nameString.'*');
            if ($files) {
                foreach ($files as $file) {
                    //File::delete($file);
                }
            }
            foreach ($request->file('hotel_image') as $key => $image) {
                $imageName = 'htl_'.$hotel_nameString.'_'.time().'_'.$key.'.'.$image->getClientOriginalExtension();
                $image->storeAs('hotel_image/', $imageName);
                $uploadedImages[] = $imageName;
            }
            //$imageNameAll = implode('||', $uploadedImages);
            //$row_data['hotel_image'] = $imageNameAll;
        }
        $imageNameAll = array_merge($remains_Photo, $uploadedImages);
        if(!empty($imageNameAll)){
            $imageNames = implode('||', $imageNameAll);
            $row_data['hotel_image'] = $imageNames;
        }
        $row_data['image_path'] = asset('storage/app/hotel_image').'/';
        /*
        echo '<pre>'; print_r($saved_hotel_imageAll);
        echo '<pre>'; print_r($deleted_Imgs);
        echo '<pre>'; print_r($remains_Photo);
        echo '<br>All Image <pre>'; print_r($imageNameAll);
        echo '<br>All Image <pre>'; print_r($imageNames);
        die;
        */
        $eventcd_prv = $row_id = 0;
        if($cd > 0){
            $query_find = DB::table('hotels')->where('htl_id', $cd)->first();
            $eventcd_prv = @$query_find->evv_id;
        }
        if($cd > 0 && $eventcd_prv == $eventcd){
            $row_data['updated_at'] = $today;
            $query_run = DB::table('hotels')->where('htl_id', $cd)->update($row_data);
            $row_id = $cd;
        }else{
            $row_data['create_by'] = $userId;
            $row_data['created_at'] = $today;
            $row_id = $query_run = DB::table('hotels')->insertGetId($row_data);
        }
        if($query_run){
            if($prv_cd > 0 && trim($prv_cd) != ''){
                $SoftDel = DB::table('hotels_category')->where('htl_idd', $row_id)->where('soft_delete_yn', 0)->update(['soft_delete_yn' => 1, 'soft_delete_date' => $today]);
            }
            $itm_success = $itm_wrong = 0;
            foreach ($category_info as $key => $item) {
                $itemArr = explode('^', $item);

                $intcd          = $itemArr[0];
                $cat_name       = $itemArr[1];
                $no_of_rooms    = $itemArr[2];
                $room_level     = $itemArr[3];

                $categoryData = [];
                
                $categoryData['hotel_category']     = ucwords(@$cat_name);
                $categoryData['hotel_nm']           = ucwords($hotel_name);
                $categoryData['total_rooms']        = $no_of_rooms;
                $categoryData['room_level']         = $room_level;
                $categoryData['create_by']          = $userId;
                $categoryData['evv_id'] = @$eventcd;

                $findAvt = DB::table('hotels_category')->where('htl_cat_id', $intcd)->where('htl_idd', $row_id)->first();
                if ($findAvt && $eventcd_prv == $eventcd) {
                    $occupied_rooms_pre = $findAvt->occupied_rooms;
                    $vacent_rooms_new = $no_of_rooms - $occupied_rooms_pre;
                    $categoryData['updated_at']           = $today;
                    $categoryData['soft_delete_date']     = NULL;
                    $categoryData['soft_delete_yn']       = 0;
                    $categoryData['vacent_rooms']   = $vacent_rooms_new;
                    $subQueryRun = DB::table('hotels_category')->where('htl_cat_id', $intcd)->where('htl_idd', $row_id)->update($categoryData);
                }else{
                    $categoryData['htl_idd']        = $row_id;
                    $categoryData['created_at']     = $today;
                    $categoryData['occupied_rooms'] = 0;
                    $categoryData['vacent_rooms']   = $no_of_rooms;
                    $subQueryRun = DB::table('hotels_category')->insert($categoryData);
                }

                if($subQueryRun){
                    $itm_success++;
                }else{
                    $itm_wrong++;
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
                $dataMsg['message'] = "Not update Successfully";
            }else{
                $dataMsg['message'] = "Not insert Successfully"; 
            }
        }
        return redirect()->route('hotel')->with('message', $dataMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $del_id = $request->id;
        $runQuery = DB::table('hotels_category')->where('htl_idd', $del_id)->delete();
        $runQuery = DB::table('hotels')->where('htl_id', $del_id)->delete();
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }
}
