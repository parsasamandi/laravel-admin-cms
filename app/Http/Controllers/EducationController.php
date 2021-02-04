<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Education;
use App\DataTables\EducationDataTable;
use App\Providers\Action;
use App\Http\Requests\StoreEducationRequest;
use App\Providers\SuccessMessages;

class EducationController extends Controller
{
    public $education = '\App\Models\Education';

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

    // Store Education
    public function store(StoreEducationRequest $request,SuccessMessages $message) {
        
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

        $output = array('success' => $success_output);

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
    public function edit(Action $action,Request $request) {
        return $action->edit($this->education,$request->get('id'));
    }

    // Delete Each Education
    public function delete(Action $action, $id) {
        return $action->delete($this->education,$id);
    }  

}
