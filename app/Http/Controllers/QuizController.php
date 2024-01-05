<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
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


class QuizController extends Controller
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
        $quiz_list = DB::table('quizs')
                    ->where(function ($query) use ($search) {
                        $query->where('question', 'like', '%'.$search.'%');
                    })->where('delete_yn', 0)->paginate($length);
        $data['quiz_list'] = $quiz_list;
        $data['list_length'] = $length;
        $data['list_search'] = $search;
        return view('quiz', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($ae, $id = 0)
    {
        $data = [];
        if($id > 0){
            $quiz = DB::table('quizs')->where('qz_id', $id)->first();
            $data['quiz'] = $quiz;
        }
        return view('quizae', $data);
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
            'question' => ['required',
                Rule::unique('quizs')->ignore($cd, 'qz_id')->where(function ($query) use ($request) {
                    // Check for existence of the question in uppercase
                    $query->where(DB::raw('UPPER(question)'), strtoupper($request->question));
                }),
            ],
            'option_1' => ['required'],
            'option_2' => ['required'],
            'answer' => ['required'],
        ], [
            'question.required' => 'Question is required field.',
            'question.unique' => 'The question has already been taken.',
            'option_1.required' => 'Option 1 is required field.',
            'option_2.required' => 'Option 2 is required field.',
            'answer.required' => 'Answer is required field.'
        ]); 
 
        if($validateData->fails()){
            return redirect()->back()->withErrors($validateData)->withInput();
        }

        //print_r($request->all());

        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');
        $quiz_data = [];
        $quiz_data['question'] = $request->question;
        $quiz_data['option_1'] = @$request->option_1;
        $quiz_data['option_2'] = @$request->option_2;
        $quiz_data['option_3'] = @$request->option_3;
        $quiz_data['option_4'] = @$request->option_4;
        $quiz_data['answer']   = $request->answer;

        
        if($cd > 0){
            $quiz_data['updated_at'] = $today;
            $quiz_run = DB::table('quizs')->where('qz_id', $cd)->update($quiz_data);
        }else{
            $quiz_data['user_id'] = $userId;
            $quiz_data['created_at'] = $today;
            $quiz_run = DB::table('quizs')->insert($quiz_data);
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
        return redirect()->route('quiz.ae', ['ae' => 'add'])->with('message', $dataMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $today = date('Y-m-d H:i:s');
        $qz_id = $request->id;
        $runQuery = DB::table('quizs')->where('qz_id', $qz_id)->update(['delete_yn' => 1, 'delete_date' => $today]);
        if($runQuery){
            $status = 1;
            $message = "Delete successfully"; 
        }else{
            $status = 3;
            $message = "Not delete"; 
        }
        return trim('||'.$message.'||'.$status);
    }

    public function importQuizIndex()
    {
        $data = [];
        $data['showlist'] = '';
        return view('import_quiz', $data);
    }
    public function importQuizShow(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|max:2048', // Adjust the validation rules as needed
        ]);
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

        try {
            $excelRows = [];
            $file = $request->file('excel_file');
            // Define your custom validation logic here
            $excelData = Excel::toArray([], $file)[0]; // Load Excel data into an array
            
            // Perform custom validation on $excelData
            foreach ($excelData as $key => $row) {
                // Perform validation on each row
                $lastRow = count($row);
                if($key > 0){
                    
                    //echo '<pre>'; print_r($row);
                    $sno        = $row[0];
                    $question   = trim($row[1]);
                    $option_1   = $row[2];
                    $option_2   = $row[3];
                    $option_3   = $row[4];
                    $option_4   = trim($row[5]);
                    $answer     = $row[6];

                    $result = DB::table('quizs')->where(DB::raw('UPPER(question)'), strtoupper($question))->first();
                    $resultCnt = @$result->qz_id;
                    $quiz_exist = 0;
                    if($resultCnt > 0){
                        $quiz_exist = 1;
                    }
                    $row[] = $quiz_exist;
                    $excelRows[] = $row;
                }
            }
            $data['excelRows'] = $excelRows; 
            $data['showlist'] = 1; 
            return view('import_quiz', $data);

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->failures())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing Excel data: ' . $e->getMessage());
        }
    }
    public function importQuizSave(Request $request)
    {
        $cd = 0;
        $info = $request->info;
        $info = explode('##', $info);

        $question = trim($info[0]);
        $option_1 = trim($info[1]);
        $option_2 = trim($info[2]);
        $option_3 = trim($info[3]);
        $option_4 = trim($info[4]);
        $answer   = trim($info[5]);

        $errors = 0;
        $dataMsg = $errorsMsg = [];
        if($question == null || empty($question)){
            $errors = 1;
            $errorsMsg['question'] = 'Question is required field.';
        }
        if($option_1 == null || empty($option_1)){
            $errors = 1;
            $errorsMsg['option_1'] = 'Option 1 is required field.';
        }
        if($option_2 == null || empty($option_2)){
            $errors = 1;
            $errorsMsg['option_2'] = 'Option 2 is required field.';
        }
        if($answer == null || empty($answer)){
            $errors = 1;
            $errorsMsg['answer'] = 'Answer is required field.';
        }
        if($errors == 1){
            $errorsMsg = implode('<br>', $errorsMsg);
            $dataMsg['message'] = "Failed"; 
            $dataMsg['status']  = 0;
            return response()->json($dataMsg);
        }
        $result = DB::table('quizs')->where(DB::raw('UPPER(question)'), strtoupper($question))->first();
        $resultCnt = @$result->qz_id;
        $quiz_exist = 0;
        if($resultCnt > 0){
            $dataMsg['message'] = "Already exist."; 
            $dataMsg['status']  = 0;
            return response()->json($dataMsg);
        }
        $user = Auth()->user();
        $userId = $user->id;
        $today = date('Y-m-d H:i:s');

        $quiz_data = [];
        $quiz_data['question'] = $question;
        $quiz_data['option_1'] = @$option_1;
        $quiz_data['option_2'] = @$option_2;
        $quiz_data['option_3'] = @$option_3;
        $quiz_data['option_4'] = @$option_4;
        $quiz_data['answer']   = $answer;

        /*
        if($cd > 0){
            $quiz_data['updated_at'] = $today;
            $quiz_run = DB::table('quizs')->where('qz_id', $cd)->update($quiz_data);
        }else{
            $quiz_data['user_id'] = $userId;
            $quiz_data['created_at'] = $today;
            $quiz_run = DB::table('quizs')->insert($quiz_data);
        }*/
        $quiz_data['created_at'] = $today;
        $quiz_data['user_id'] = $userId;
        $quiz_run = DB::table('quizs')->insert($quiz_data);
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
        return response()->json($dataMsg);
    }
}
