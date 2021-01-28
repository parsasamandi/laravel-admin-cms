<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\ProjectDataTable;
use App\Models\Project;
use App\Models\Description;
use App\Models\Media;

class ProjectController extends Controller
{
    // Project Table
    public function list() {
        // DataTable
        $dataTable = new ProjectDataTable();

        // Project Table
        $vars['projectTable'] = $dataTable->html();

        return view('projectList', $vars);
    }

    // Get Project
    public function projectTable(ProjectDataTable $dataTable) {
        return $dataTable->render('projectList');
    }

    // Store Project
    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'background' => 'required',
            'section_id' => 'required'
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
            if($request->get('#button_action') == "insert") {
                $this->newProject($request);
                $success_output = '<div class="alert alert-success">The data is submitted successfully</div>';
            }
            // Update
            else if($request->get('#button_action') == "update") {
                $this->newProject($request);
                $success_output = '<div class="alert alert-success">The data is updated successfully</div>';
            }
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return json_encode($output);
    }
 
    // New Project Page
    public function newProject($request)
    {
        // Edit
        $project = Project::find($request->get('id'));
        if(!$project) {
            // Insert
            $project = new Project();
        }
        $project->name = $request->get('name');
        $project->background_color = $request->get('background');
        $project->section_id = $request->get('section_id');

        $project->save();
    }
    // Edit Project Page
    public function edit(Request $request)
    {
        $project = Project::find($request->get('id'));
        return json_encode($project);
    }

    // Delete Project
    public function delete($id) {
        $project = Project::find($id);
        if($project) {
            $project->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    
}
