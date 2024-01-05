<?php

namespace App\Http\Controllers;

use App\Models\About;
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

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($about)
    {
        $abouts_info = DB::table('abouts')->first();
        $data['abouts_info'] = $abouts_info;
        $data['about_type'] = $about;
        return view('about', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //print_r($request->all());
        $about_type = $request->about_type;
        $editor = $request->editor;

        $aboutData = [];
        if($about_type == 'ongc'){
            $aboutData['about_ongc'] = $editor;
        }else if($about_type == 'iew'){
            $aboutData['about_iew'] = $editor;
        }else if($about_type == 'event_location'){
            $aboutData['about_local_event'] = $editor;
        }
        if(!empty(trim($about_type))){
            $queryUpdate = DB::table('abouts')->update($aboutData);
            if($queryUpdate){
                $status = 1;
                $message = "Update Successfully"; 
            }else{
                $status = 3;
                $message = "Not Update"; 
            }
        }else{
            $status = 3;
            $message = "Page not found. "; 
        }
        $dataMsg['status'] = $status;
        $dataMsg['message'] = $message;
        return redirect()->route('about.links', ['about' => $about_type])->with('message', $dataMsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
