<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Education;
use App\DataTables\EducationDataTable;
use App\Providers\SuccessMessages;

class EducationController extends Controller
{
    
    // Education Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new EducationDataTable();

        $vars['educationTable'] = $dataTable->html();

        return view('educationList', $vars);
    }

    // DataTable
    public function educationTable(EducationDataTable $dataTable) {
        return $dataTable->render('educationList');
    }

    // Store Description
    public function store(Request $request,SuccessMessages $message)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'university_description' => 'required'
        ]);
 
        $error_array = array();
        $success_output = '';
        
        // Validation
        if($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        }
        else {
            // Insert
            if($request->get('button_action') == "insert") {
                $this->addEducation($request);
                $success_output =  $message->getInsert();
            }
            // Update
            else if($request->get('button_action') == "update") {
                $this->addEducation($request);
                $success_output = $message->getUpdate();
            }
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );
 
        return json_encode($output);
    }

    // Add Education
    public function addEducation($request) {
        // Edit
        $educ = Education::find($request->get('id'));
        // Insert
        if(!$educ) {
            $educ = new Education();
        }
        $educ->name = $request->get('name');
        $educ->GPA = $request->get('GPA');
        $educ->degree = $request->get('degree');
        $educ->TOEFL = $request->get('toefl');
        $educ->education_period = $request->get('period');
        $educ->Thesis_topic = $request->get('thesis_topic');
        $educ->university_desc = $request->get('university_description');

        $educ->save();
    }

    // Edit Education
    public function edit(Request $request)
    {
        $educ = Education::find($request->get('id'));
        return json_encode($educ);
    }

    // Delete Each Education
    public function delete(Request $request, $id) {
        $educ = Education::find($id);
        if($educ) {
            $educ->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }  


    // // Search Education
    // public function search(Request $request)
    // {   
    //     if(!empty($request->input('name')))
    //     {
    //         $name = $request->get('name');
    //         $education = Education::where('name','LIKE','%'.$name.'%')->paginate(5);
    //         if(count($education) > 0)
    //             return view('/education/educationList',['education' => $education]);
    //         else 
    //             return back()->with('faliure', 'There were no results. please try again');
    //     }
    // }

    // Show Each Education
    // public function show($id)
    // {
    //     $education = Education::findOrFail($id);
    //     return view('education.eachEducation', ['education' => $education]);
    // }

}
