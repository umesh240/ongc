<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
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

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs_list = DB::table('faqs')->where('delete_yn', 0)->orderByRaw('order_by = 0, order_by asc')->get();
        $data['faqs_list'] = $faqs_list;
        return view('faq', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($ae, $id = 0)
    {
        $data = [];
        if($id > 0){
            $faq = DB::table('faqs')->where('faq_id', $id)->first();
            $data['faq'] = $faq;
        }
        return view('faqae', $data);
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
        $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'question' => ['required'],
            'answer' => ['required'],
        ], [
            'question.required' => 'Question is required field.',
            'answer.required' => 'Answer is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        //print_r($request->all());

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $rowData = [];
        $rowData['question']    = @$request->question;
        $rowData['answer']      = @$request->answer;

        if($cd > 0){
            $rowData['updated_at'] = $today;
            $query_run = DB::table('faqs')->where('faq_id', $cd)->update($rowData);
        }else{
            $rowData['create_by'] = $userId;
            $rowData['created_at'] = $today;
            $query_run = DB::table('faqs')->insert($rowData);
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
                $dataMsg['message'] = "Not update Successfully";
            }else{
                $dataMsg['message'] = "Not insert Successfully"; 
            }
        }
        return redirect()->route('faqs')->with('message', $dataMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $rowData = ['delete_date' => date('Y-m-d H:i:s'), 'delete_yn' => 1];
        $runQuery = DB::table('faqs')->where('faq_id', $id)->update($rowData);
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }
    public function faqsSort(Request $request)
    {
        $idds = $request->idds;
        foreach ($idds as $key => $id) {
            $runQuery = DB::table('faqs')->where('faq_id', $id)->update(['order_by' => $key + 1]);
        }
        $status = 1;
        $message = "Update successfully"; 
        return trim('||'.$message.'||'.$status);
    }
}
