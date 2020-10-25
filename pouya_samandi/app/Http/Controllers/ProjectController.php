<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Project;

class ProjectController extends Controller
{
    // Show Project Page
    public function index()
    {
        $project = Project::all();
        $description = Description::all();
        $media = Media::all();
        return view('/project', [
            'projects' => $project,
            'descriptions' => $description,
            'media' => $media
        ]);
    }

    // New Project Page
    public function new()
    {
        return view('project/newProject');
    }
 
    // New Project Page
    public function store(Request $request)
    {
        $project = new Project();
        $project->name = request('name');
        $project->background_color = request('background');
        $project->section_id = request('section_id');

        $project->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Edit Project Page
    public function edit($id)
    {
        $project = Project::where('project_id', $id)->first();
        return view('project.editProject', ['project' => $project]);
    }
    // Update Project Page
    public function update($id,Request $request)
    {

        Project::where('project_id', $id)->update(array(
            'name' => request('name'),
            'background_color' => request('background'),
            'section_id' => request('section_id'),
        ));
        return redirect('project/projectList');
    }
    // Delete Project
    public function destroy($id)
    {
        $project = Project::where('project_id', $id);
        $project->delete();

        return redirect('project/projectList');
    }
    // Delete Project
    public function search(Request $request)
    {
        if(!empty($request->input('name')))
        {
            $name = $request->get('name');
            $project = Project::where('name','LIKE','%'.$name.'%')->paginate(5);
            if(count($project) > 0)
                return view('/project/projectList',['project' => $project]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }

    // Show Project List
    public function index()
    {
        $project = Project::all();
        return view('project/projectList',[
            'project' => $project
        ]);
    }
    
}
