<?php

namespace App\Http\Controllers;

use App\Models\Leaders;
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
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class LeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($length='', $search='')
    {
        if(empty($length)){
            $length = 10;
        }
        //$event_list = DB::table('events')->where('actv_event', 1)->paginate($length);
        /*$leaders_list = DB::table('leaders')
                    ->where(function ($query) use ($search) {
                        $query->where('l_name', 'like', '%'.$search.'%');
                        $query->orWhere('l_post', 'like', '%'.$search.'%');
                    })->where('delete_status', 0)->paginate($length);*/
        $leaders_list = DB::table('leaders')->where('delete_status', 0)->orderBy('order_by', 'asc')->get();
        $data['leaders_list'] = $leaders_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        return view('leaders', $data);
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
     * @param  \App\Models\Leaders  $leaders
     * @return \Illuminate\Http\Response
     */
    public function show($ae, $id = 0)
    {
        $data = [];
        if($id > 0){
            $leader = DB::table('leaders')->where('ldr_id', $id)->first();
            $data['leader'] = $leader;
        }
        return view('leadersae', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leaders  $leaders
     * @return \Illuminate\Http\Response
     */
    public function edit(Leaders $leaders)
    {
        echo 123123;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leaders  $leaders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'l_name' => ['required',
                Rule::unique('leaders')->ignore($cd, 'ldr_id')->where(function ($query) use ($request) {
                    // Check for existence of the question in uppercase
                    $query->where('l_name', ucwords($request->l_name));
                }),
            ],
            'l_post' => ['required']
        ], [
            'l_name.required' => 'Name is required field.',
            'l_name.unique' => 'The name has been already saved.',
            'l_post.required' => 'Post is required field.'
        ]); 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        if($cd <= 0 || trim($cd) == ''){
            // Check file extension manually
            if ($request->hasFile('l_photo')) {
                $file = $request->file('l_photo');
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $validateMsg = ['l_photo'=> 'The photo file must be a file of type: jpg, jpeg, png'];
                    return redirect()->back()->withErrors($validateMsg)->withInput();
                }
            }
            
        }
        
        try {
            $user = Auth()->user();
            $user_id = $user->id;
            $today = date('Y-m-d H:i:s');
            $l_name = ucwords(@$request->l_name);
            $l_post = ucwords(@$request->l_post);

            $rowData = [];
            $directory = storage_path('app/leaders_photo');
            if ($request->hasFile('l_photo')) {
                $photo = @$request->file('l_photo');
                if(!is_dir($directory)){    mkdir($directory);    }
                if($cd > 0){
                    $getData = DB::table('leaders')->where('ldr_id', $cd)->first();
                    $l_photo_old = $getData->l_photo;
                    if(trim(@$l_photo_old) != ''){
                        File::delete($directory.'/'.$l_photo_old);
                    }
                }
                $l_nameString = str_replace(' ', '', $l_name);
                $photoName = 'leader_'.$l_nameString.'_'.time().'.'.$photo->getClientOriginalExtension();
                $photo->storeAs('leaders_photo/', $photoName);
                $rowData['l_photo'] = $photoName;
            }
            $rowData['l_name'] = $l_name;
            $rowData['l_post'] = $l_post;

            if($cd > 0){
                $rowData['updated_at'] = $today;
                $query_run = DB::table('leaders')->where('ldr_id', $cd)->update($rowData);
            }else{
                $rowData['created_at'] = $today;
                $rowData['create_by'] = $user_id;
                $query_run = DB::table('leaders')->insert($rowData);
            }
            if($query_run){
                $dataMsg['status'] = 1;
                if($cd > 0){
                    $dataMsg['message'] = "Update Successfully"; 
                }else{
                    $dataMsg['message'] = "Insert Successfully"; 
                }
            }else{
                $dataMsg['status'] = 3;
                if($cd > 0){
                    $dataMsg['message'] = "Updatation failed.";
                }else{
                    $dataMsg['message'] = "Insertation failed."; 
                }
            }
            return redirect()->route('leaders')->with('message', $dataMsg);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing with data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leaders  $leaders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $rowData = [];
        $rowData['delete_status'] = 1;
        $rowData['delete_date'] = date('Y-m-d H:i:s');
        $runQuery = DB::table('leaders')->where('ldr_id', $id)->update($rowData);
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }

    public function leadersSort(Request $request)
    {
        $idds = $request->idds;
        $idds = explode(',', $idds);
        //print_r($idds); die;
        foreach ($idds as $key => $id) {
            $runQuery = DB::table('leaders')->where('ldr_id', $id)->update(['order_by' => $key + 1]);
        }
        $status = 1;
        $message = "Update successfully"; 
        return trim('||'.$message.'||'.$status);
    }
}
