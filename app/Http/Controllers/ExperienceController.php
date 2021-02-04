<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ExperienceDataTable;
use App\Providers\Action;
use App\Models\Experience;
use App\Providers\SuccessMessages;
use File;

class ExperienceController extends Controller
{
    public $experience = '\App\Models\Experience';
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
    public function store(StoreExperienceRequest $request,SuccessMessages $message)
    {
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

        $output = array('success' => $success_output);

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
       return $action->edit($this->experience,$request->get('id'));
    }

    // Delete Each Experience
    public function delete(Action $action, $id) {
        return $action->delete($this->experience,$id);
    }  

    
}
