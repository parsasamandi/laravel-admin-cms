<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Description;

class DescriptionController extends Controller
{
    // New Description Page
    public function new(Request $request)
    {
        $project = Project::select('name','project_id')->get();
        $experience = Experience::select('title','id')->get();
        return view('description/newDescription',[
            'project' => $project,
            'experience' => $experience
        ]);
    }

    // Store Description
    public function store(Request $request)
    {
        $validator = $request->validate([
            'experienceBox' => 'required_without:projectBox',
            'size' => 'required_without:experienceBox',
        ]);

        $description = new Description();
        $description->desc = request('desc1');
        if(!(request('projectBox') == ''))
        {
            $description->project_id = request('projectBox');
        }
        else if(request('projectBox') == '')
        {
            $description->project_id = null;
        }
        if(!(request('experienceBox') == ''))
        {
            $description->experience_id = request('experienceBox');
        }
        else if(request('experienceBox') == '')
        {
            $description->experience_id = null;
        }
        

        $description->size = request('size');
        $description->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Description List
    public function index(Request $request)
    {
        $desc = Description::all();
        return view('description/descriptionList', [
            'desc' => $desc
        ]);
    }

    // Delete Description
    public function destroy($id)
    {
        $desc = Description::where('id', $id);
        $desc->delete();

        return redirect('/description/descriptionList');
    }

    // Search for Description
    public function search(Request $request)
    {
        if(!empty($request->input('desc')))
        {
            $desc = $request->get('desc');
            $desc = Description::where('desc','LIKE','%'.$desc.'%')->paginate(5);
            if(count($desc) > 0)
                return view('/description/descriptionList',['desc' => $desc]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }

    // Edit Description Page
    public function edit($id)
    {
        $description = Description::where('id', $id)->first();
        $project = DB::table('project')->select('name','project_id')->get();
        $experience = DB::table('experience')->select('title','id')->get();
        return view('description.editDescription', [
            'description' => $description,
            'project' => $project,
            'experience' => $experience
        ]);
    }

    // Update Description
    public function update($id,Request $request)
    {
        $validator = $request->validate([
            'experienceBox' => 'required_without:projectBox',
            'size' => 'required_without:experienceBox',
        ]);

        $description = Description::findOrFail($id);
        $description->desc = request('desc1');

        if(!(request('projectBox') == ''))
        {
            $description->project_id = request('projectBox');
        }
        else if(request('projectBox') == '')
        {
            $description->project_id = null;
        }
        if(!(request('experienceBox') == ''))
        {
            $description->experience_id = request('experienceBox');
        }
        else if(request('experienceBox') == '')
        {
            $description->experience_id = null;
        }

        $description->size = request('size');
        $description->save();
        return redirect('description/descriptionList');
    }
    
    
}
