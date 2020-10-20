<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\SubProject;
use App\Project;

class ProjectTitleController extends Controller
{
    
    // New Project TItle Page
    public function newProjectTitle(Request $request)
    {   
        $project = Project::select('name','project_id')->get();
        return view('project/newProjectTitle',[
            'project' => $project
        ]); 
    }
    // New Sub Title For Project
    public function storeProjectTitle(Request $request)
    {
        $projectTitle = new SubProject();
        $projectTitle->name = request('name');
        $projectTitle->project_id = request('projectBox');

        $projectTitle->save();
        return back()->with('success', 'You have successfully sumbitted data'); 

    }
    // Project Title List
    public function indexProjectTitle()
    {
        $subProject = SubProject::all();
        return view('project/projectTitleList', [
            'subProject' => $subProject
        ]);
    }
    // Search For Project Title
    public function searchProjectTitle(Request $request)
    {
        if(!empty($request->input('name')))
        {
            $name = $request->get('name');
            $subProject = SubProject::where('name','LIKE','%'.$name.'%')->paginate(5);
            if(count($subProject) > 0)
                return view('/project/projectTitleList',['subProject' => $subProject]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Edit Project Title
    public function editProjectTitle($id)
    {
        $project = Project::all();
        $subProject = SubProject::where('id', $id)->first();
        return view('project/editProjectTitle', [
            'project' => $project,
            'subProject' => $subProject
        ]);
    }
    // Update Project Title
    public function updateProjectTitle($id,Request $request)
    {
        $rules = [
            'projectBox' => 'required|not_in:0'
        ];

        $subProject = SubProject::findOrFail($id);
        $subProject->name = request('name');
        $subProject->project_id = request('projectBox');

        $subProject->save();
        return redirect('project/projectTitleList');
    }
    // Destroy Project Title
    public function destroyProjectTitle($id)
    {
        $projectTitle = SubProject::where('id', $id);
        $projectTitle->delete();

        return redirect('/project/projectTitleList');
    }
    
}
