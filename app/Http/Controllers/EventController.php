<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($length='', $search='')
    {
        if(empty($length)){
            $length = 10;
        }
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        $event_list = DB::table('events')
                    ->where(function ($query) use ($search) {
                        $query->where('event_name', 'like', '%'.$search.'%')
                        ->orWhere('event_location', 'like', '%'.$search.'%');
                    })->where('actv_event', 1)->paginate($length);
        $data['event_list'] = $event_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        return view('event', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($ae, $id = 0)
    {
        $data = [];
        if($id > 0){
            $event = DB::table('events')->where('actv_event', 1)->where('ev_id', $id)->first();
            $data['event'] = $event;
        }
        return view('eventae', $data);
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
        //print_r($request->all()); die;

        $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'event_name' => ['required', 'unique:events,event_name, '.$cd.',ev_id'],
            'event_datefr' => ['date'],
            'event_dateto' => ['date'],
            'event_location' => ['required'],
            'airport_name_0' => ['required'],
            'airport_location_0' => ['required'],
        ], [
            'event_name.required' => 'Event name is required field.',
            'event_datefr.date' => 'Date from is required field.',
            'event_dateto.date' => 'Date to is required field.',
            'event_location.required' => 'Event location is required field.',
            'airport_name.required' => 'Airport name is required field.',
            'airport_photo.required' => 'Airport photo is required field.',
            'airport_photo.max' => 'Airport photo is max 2 MB in size.',
            'airport_location.required' => 'Airport location is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        //$airport_nameAll = $request->airport_name;
        //$airport_nameAll = $request->input('airport_name', []);
        //foreach($airport_nameAll as $key => $airport){
        for($key = 0; $key < 3; $key++){
            $loc = $key + 1;
            $old_image_name     = $request->input("old_image_".$key);
            $airport_photo      = $request->hasFile("airport_photo_".$key);
            $airport_name       = $request->input("airport_name_".$key);
            $airport_location   = $request->input("airport_location_".$key);
            //echo '>>'.$airport_photo.'---'.$airport_name.'<br>';
            if (!empty($airport_name) ) {
                if($cd <= 0 || $cd == ''){ /// for new insert
                    if ($airport_photo != 1 || empty($airport_location)) {
                        $erros = ['airport_name' => "Please fill all fields of airport location ".$loc];
                        return redirect()->back()->withErrors($erros)->withInput();
                        
                    }else{
                        $file = $request->file("airport_photo_".$key);
                        $ext = @$file->getClientOriginalExtension();
                        if ($airport_photo == 1 && ($ext === 'jped' || $ext === 'jpg' || $ext === 'png')) {

                        }else{
                            $erros = ['airport_name' => 'airport location '.$loc.' photo is supported only .jpeg, .jpg and .png'];
                            return redirect()->back()->withErrors($erros)->withInput();
                        }
                    }
                }else{
                    if($airport_photo){
                        $file = $request->file("airport_photo_".$key);
                        $ext = @$file->getClientOriginalExtension();
                        if ($ext === 'jped' || $ext === 'jpg' || $ext === 'png') {

                        }else{
                            $erros = ['airport_name' => 'airport location '.$loc.' photo is supported only .jpeg, .jpg and .png'];
                            return redirect()->back()->withErrors($erros)->withInput();
                        }

                        if (empty($airport_location)) {
                            $erros = ['airport_name' => "Please fill all fields of airport location ".$loc];
                            return redirect()->back()->withErrors($erros)->withInput();
                            
                        }
                    }
                }
            }
        }

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $event_data = [];
        $event_name = ucwords(@$request->event_name);
        $event_city = ucwords(@$request->event_city);
        $event_data['event_name'] = $event_name;
        $event_data['event_datefr'] = @$request->event_datefr;
        $event_data['event_dateto'] = @$request->event_dateto;
        $event_data['event_location'] = ucwords(@$request->event_location);
        $event_data['event_mapurl'] = @$request->event_mapurl;
        $event_data['event_city'] = ucwords(@$request->event_city);

        $image_path = "app/airport_images";

        $airportsArr = [];
        $airportImgPath = asset("storage/".$image_path).'/';
        //foreach($airport_nameAll as $key => $airport){
        for($key = 0; $key < 3; $key++){
            $loc = $key + 1;
            $airport_name       = $request->input("airport_name_".$key);
            $airport_location   = $request->input("airport_location_".$key);
            $airport_photo      = $request->hasFile("airport_photo_".$key);
            if(!empty($airport_name)){
                if($airport_photo){
                    $airport_image      = $request->file("airport_photo_".$key);
                    $extension          = $airport_image->getClientOriginalExtension();

                    $eventNmImg = str_replace(' ', '', $event_name);
                    $eventNmImg = preg_replace('/[^A-Za-z0-9]/', '', $eventNmImg);
                    $newName = 'ap_'.$eventNmImg.'_' . time() . '_'.$loc.'.' . $extension;
                    $airport_image->storeAs('airport_images', $newName);
                    $airportsArr[] = array("id" => $key, "airport_name" => $airport_name, "airport_location" => $airport_location, "airport_photo" => $airportImgPath.$newName);
                }else{
                    $airport_photo = $request->input("old_image_".$key);
                    $airportsArr[] = array("id" => $key, "airport_name" => $airport_name, "airport_location" => $airport_location, "airport_photo" => $airport_photo);
                }
            }
        }
        $folderPath = storage_path($image_path);
        File::chmod($folderPath, 0755);
        //print_r($airportsArr); die;
        $airportsArr = json_encode($airportsArr);
        $event_data['airports'] = @$airportsArr;
        
        $directory = storage_path('app/event_pdf');
        
        if ($request->hasFile('event_details')) {
            $pdf = @$request->file('event_details');
            if(!is_dir($directory)){    mkdir($directory);    }
            if($cd > 0){
                $getPdf = DB::table('events')->where('ev_id', $cd)->first();
                $event_details_old = $getPdf->event_details;
                if(trim(@$event_details_old) != ''){
                    //File::delete($directory.'/'.$event_details_old);
                }
            }
            $event_nameString = str_replace(' ', '', $event_name);
            $pdfName = 'evdtl_'.$event_nameString.'_'.time().'.'.$pdf->getClientOriginalExtension();
            $pdf->storeAs('event_pdf/', $pdfName);
            $event_data['day_wise'] = $pdfName;
        }
        File::chmod($directory, 0755);
        $event_data['pdf_path'] = asset('storage/app/event_pdf').'/';
        if($cd > 0){
            $event_data['updated_at'] = $today;
            $event_run = DB::table('events')->where('ev_id', $cd)->update($event_data);
        }else{
            $event_data['create_by'] = $userId;
            $event_data['created_at'] = $today;
            $event_run = DB::table('events')->insert($event_data);
        }
        if($event_run){
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
        return redirect()->route('event')->with('message', $dataMsg);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ev_id = $request->id;
        $runQuery = DB::table('events')->where('ev_id', $ev_id)->delete();
        if($runQuery){
            $status = 1;
            $message = "delete Successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }

    public function eventWheather($event_id)
    {
        $runQuery = DB::table('events')->where('ev_id', $event_id)->first();
        if($runQuery){
            $current_date = date('Y-m-d H:i:s');
            $updateTime = $latestTime = strtotime($current_date);
            $event_city = $runQuery->event_city;
            $last_update = $runQuery->last_update;
            $weather_result = $runQuery->weather_result;

            if($last_update != null){
                //$convertedTime = date('Y-m-d H:i:s', strtotime('+2 minutes', strtotime($current_date)));
                $updateTime = strtotime('+3 minutes', strtotime($last_update));
            }
            if(($last_update == null || $updateTime < $latestTime) && $event_city != null){
                $appid = env('WHEATHER_APP_ID');
                $url = "http://api.openweathermap.org/data/2.5/weather?q=".$event_city."&appid=".$appid; 
                                                                //49c0bad2c7458f1c76bec9654081a661
                //echo $url; die;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                $weather_result = $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result, true);
                if($result['cod'] == 200){
                // echo "<pre>"; print_r($result);die;
                    $wheatherData['last_update']    = $current_date;
                    $wheatherData['weather_result'] = $weather_result;
                    $runQuery = DB::table('events')->where('ev_id', $event_id)->update($wheatherData);

                    $status = 200;
                    if($runQuery){
                        $message = "Wheather info updated.";
                    }else{
                        $message = "Wheather info not update.";
                    }
                }else{
                    $status = 400;
                    $message = "Wheather not update in our record.";
                }
                return response()->json(['status' => $status, "message" => $message]);
            }
        }
    }
}
