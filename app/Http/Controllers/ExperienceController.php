<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ExperienceDataTable;
use App\Providers\Action;
use App\Models\Experience;
use App\Providers\SuccessMessages;

class ExperienceController extends Controller
{
    // Experience Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new ExperienceDataTable();

        $vars['experienceTable'] = $dataTable->html();

        return view('experienceList', $vars);
    }

    // DataTable
    public function experienceTable(ExperienceDataTable $dataTable) {
        return $dataTable->render('experienceList');
    }
    
    // Store Description
    public function store(Request $request,SuccessMessages $message)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required'
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
                $this->addExperience($request);
                $success_output = $message->getInsert();
            }
            // Update
            else if($request->get('button_action') == "update") {
                $this->addExperience($request);
                $success_output = $message->getUpdate();
            }
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return json_encode($output);
    }

    // Add Or Update Experience
    public function addExperience($request) {
        // Edit
        $exper = Experience::find($request->get('id'));
        if(!$exper) {
            // Insert
            $exper = new Experience();
        }

        $exper->title = $request->get('title');
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $exper->image = $file;
        }
        
        $exper->save();
    }

    // SubSet
    public function subSet($request) {
        switch($request) {
            case '':
                return null;
                break;
            default:
                return $request;
        }
    }

    // Edit
    public function edit(Request $request,Action $action) {
       return $action->edit('\App\Models\Experience',$request->get('id'));
    }

    // Delete Each Experience
    public function delete(Request $request, $id) {
        $exper = Experience::find($id);
        if($exper) {
            $imageDelete = public_path("images/$exper->image");
            if($imageDelete) {
                File::delete($imageDelete); 
            }
            $exper->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }  

    
}
