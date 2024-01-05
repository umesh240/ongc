<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
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


class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $feedback_list = DB::table('feedbacks')->where('delete_yn', 0)->orderByRaw('order_by = 0, order_by asc')->get();
        $data['feedback_list'] = $feedback_list;
        return view('feedback', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cd = @$request->cd;
        $validateData = Validator::make($request->all(), [
            'feedback' => ['required']
         ], [
            'feedback.required' => 'Feedback is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $row_data = [];
        $row_data['feedback'] = $request->feedback;
        
        if($cd > 0){
            $row_data['updated_at'] = $today;
            $quiz_run = DB::table('feedbacks')->where('fb_id', $cd)->update($row_data);
        }else{
            $row_data['created_at'] = $today;
            $quiz_run = DB::table('feedbacks')->insert($row_data);
        }
        if($quiz_run){
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
        return redirect()->route('feedback')->with('message', $dataMsg);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $today = date('Y-m-d H:i:s');
        $fb_id = $request->id;
        $runQuery = DB::table('feedbacks')->where('fb_id', $fb_id)->update(['delete_yn' => 1, 'delete_date' => $today]);
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }

    public function feedbackSort(Request $request)
    {
        $idds = $request->idds;
        foreach ($idds as $key => $id) {
            $runQuery = DB::table('feedbacks')->where('fb_id', $id)->update(['order_by' => $key + 1]);
        }
        $status = 1;
        $message = "Update successfully"; 
        return trim('||'.$message.'||'.$status);
    }
}
