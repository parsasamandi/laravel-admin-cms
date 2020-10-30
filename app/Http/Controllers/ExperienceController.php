<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Experience;

class ExperienceController extends Controller
{
    
    // new Experience page
    public function new(Request $request)
    {
        return view('/experience/newExperience');
    }
    // Insert Experience
    public function store(Request $request)
    {
        $exper = new Experience();
        // completed
        $exper->title = request('Title');

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $exper->image = $file;
        }

        $exper->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Show Each Experience
    public function index() {
        $experience = Experience::all();      
        return view('experience/experienceList', [
          'experience' => $experience,
        ]);
    }   
    // Search for experience
    public function search(Request $request)
    {
        if(!empty($request->input('title')))
        {
            $title = $request->get('title');
            $experience = Experience::where('title','LIKE','%'.$title.'%')->get();
            if(count($experience) > 0)
                return view('/experience/experienceList',['experience' => $experience]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc1')))
        {
            $experience = Experience::whereHas('description', function ($query){
                $query->where('desc', 'LIKE', '%'.request('desc1').'%');
            })->get();
            if(count($experience) > 0)
                return view('/experience/experienceList',['experience' => $experience]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Delete Experience
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $imageDelete = public_path("images/$experience->image");
        if(File::exists($imageDelete))
        {
            File::delete($imageDelete); 
        }
        $experience->delete();
        return redirect('experience/experienceList');
    }
    // Show Each Experience
    public function show($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experience.eachExperience', ['experience' => $experience]);
    }
    // Edit Experience Page
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experience.editExperience', ['experience' => $experience]);
    }
    // update Experience
    public function update($id,Request $request)
    {
        $exper = Experience::findOrFail($id);
        $exper->title = request('Title');

        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$exper->image");
            if(File::exists($imageDelete))
            {
                File::delete($imageDelete); 
            }
            
            $image = request('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $exper->image = $file;
        }

        $exper->save();
        return redirect('experience/experienceList');
    }
    
}
