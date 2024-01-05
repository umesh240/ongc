<?php

namespace App\Http\Controllers;

use App\Models\ContactSos;
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

class ContactSosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        $sos_contact = DB::table('contactsos')->first();
        $data['sos_contact'] = $sos_contact;
        return view('sos_contact', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
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
        /*
        $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'event_name' => ['required', 'unique:events,event_name, '.$cd.',ev_id'],
            'event_datefr' => ['date'],
            'event_dateto' => ['date'],
            'event_location' => ['required'],
        ], [
            'event_name.required' => 'Event name is required field.',
            'event_datefr.date' => 'Date from is required field.',
            'event_dateto.date' => 'Date to is required field.',
            'event_location.required' => 'Event location is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        */
        //print_r($request->all());

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $sos_data = [];
        $sos_data['email_id'] = @$request->email_id;
        $sos_data['phone_no'] = @$request->mobile_no;
        $sos_data['sos_info'] = @$request->sos_info;
        // $sos_data['created_at'] = $today;
        $sos_data['updated_at'] = $today;
        $sos_data['create_by'] = $userId;

        $queryUpdate = DB::table('contactsos')->update($sos_data);
        if($queryUpdate){
            $status = 1;
            $message = "Update Successfully"; 
        }else{
            $status = 3;
            $message = "Not Update"; 
        }
        $dataMsg['status'] = $status;
        $dataMsg['message'] = $message;
        return redirect()->route('sos_contact')->with('message', $dataMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    }
}
