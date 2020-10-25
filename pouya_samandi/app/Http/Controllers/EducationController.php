<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Education;

class EducationController extends Controller
{
    
    // New Education Page
    public function new()
    {
        return view('education.newEducation');
    }
    // Show Each Education
    public function index()
    {
        $education = Education::all();      
        return view('education/educationList', [
          'education' => $education,
        ]);
    }
    // Insert Education
    public function store()
    {
        $educ = new Education();
        $educ->name = request('name');
        $educ->GPA = request('GPA');
        $educ->degree = request('degree');
        $educ->TOEFL = request('toefl');
        $educ->education_period = request('period');
        $educ->Thesis_topic = request('thesis_topic');
        $educ->university_desc = request('university_description');

        $educ->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Delete Education
    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return redirect('education/educationList');
    }
    // Search Education
    public function search(Request $request)
    {   
        if(!empty($request->input('name')))
        {
            $name = $request->get('name');
            $education = Education::where('name','LIKE','%'.$name.'%')->paginate(5);
            if(count($education) > 0)
                return view('/education/educationList',['education' => $education]);
            else 
                return back()->with('faliure', 'There were no results. please try again');

        }
        if(!empty($request->input('degree')))
        {
            $degree = $request->get('degree');
            $education = Education::where('degree','LIKE','%'.$degree.'%')->paginate(5);
            if(count($education) > 0)
                return view('/education/educationList',['experience' => $education]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('Thesis_topic')))
        {
            $Thesis_topic = $request->get('Thesis_topic');
            $education = Education::where('Thesis_topic','LIKE','%'.$Thesis_topic.'%')->paginate(5);
            if(count($education) > 0)
                return view('/education/educationList',['education' => $education]);
            else 
                return back()->with('faliure', 'There were no results.please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Edit Education Page
    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('education.editEducation',['education' => $education]);
    }
    // Update Education
    public function update($id)
    {
        $educ = Education::findOrFail($id);
        $educ->name = request('name');
        $educ->GPA = request('GPA');
        $educ->degree = request('degree');
        $educ->TOEFL = request('toefl');
        $educ->education_period = request('period');
        $educ->Thesis_topic = request('thesis_topic');
        $educ->university_desc = request('university_description');

        $educ->save();
        return redirect('education/educationList');
    }
    // Show Each Education
    public function show($id)
    {
        $education = Education::findOrFail($id);
        return view('education.eachEducation', ['education' => $education]);
    }

}
