<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Refree;
use App\Models\Experience;
use App\Models\Skill;

class SkillController extends Controller
{
    // new Skill Page
    public function new()
    {
        return view('skill.newSkill');
    }

    // store Skill
    public function store(Request $request)
    {
        $skill = new Skill();
        $skill->title = request('Title');
        $skill->desc = request('desc1');
        $skill->desc2 = request('desc2');
        $skill->desc3 = request('desc3');
        $skill->title2 = request('Title2');
        $skill->desc4 = request('desc4');
        $skill->desc5 = request('desc5');
        $skill->desc6 = request('desc6');

        $skill->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Skill page
    public function index()
    {
        $skill = Skill::all();      
        return view('skill/skillList', [
        'skill' => $skill
        ]);
    }

    // Show Each Skill
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect('skill/skillList');
    }

    // Edit Skill
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('skill/editSkill', [
            'skill' => $skill
        ]);
    }

    // Update Skill
    public function update($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->title = request('Title');
        $skill->desc = request('desc1');
        $skill->desc2 = request('desc2');
        $skill->desc3 = request('desc3');
        $skill->title2 = request('Title2');
        $skill->desc4 = request('desc4');
        $skill->desc5 = request('desc5');
        $skill->desc6 = request('desc6');

        $skill->save();
        return redirect('skill/skillList');
    }

    // Show Each Skill
    public function show($id)
    {
        $eachSkill = Skill::findOrFail($id);
        return view('skill.eachSkill', ['eachSkill' => $eachSkill]);
    }
    // Search in Skill
    public function search(Request $request)
    {
        if(!empty($request->input('title')))
        {
            $title = $request->get('title');
            $skill = Skill::where('title','LIKE','%'.$title.'%')->paginate(5);
            if(count($skill) > 0)
                return view('/skill/skillList',['skill' => $skill]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc')))
        {
            $desc = $request->get('desc');
            $skill = Skill::where('desc','LIKE','%'.$desc.'%')->paginate(5);
            if(count($skill) > 0)
                return view('/skill/skillList',['skill' => $skill]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc2')))
        {
            $desc2 = $request->get('desc2');
            $skill = Skill::where('desc2','LIKE','%'.$desc2.'%')->paginate(5);
            if(count($skill) > 0)
                return view('skill/skillList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
    
    
}
