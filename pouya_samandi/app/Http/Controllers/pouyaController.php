<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pouya;
use App\Experience;
use App\Education;
use App\Universities;
use App\Publication;
use App\Interest;
use App\User;
use App\Skill;
use App\home_setting;
use App\Refree;
use App\Media;
use App\Description;
use App\Media_text;
use App\Project;
use App\link;
use App\SubProject;
use DataTables;
use Auth;
use File;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;



class pouyaController extends Controller
{

    // CV page
    public function indexCv()
    {
        $experience = Experience::all();      
        $education = Education::all();   
        $publication = Publication::all();   
        $interest = Interest::all();   
        $skill = Skill::all();   
        $refree = Refree::all();   
        return view('cv', [
            'experience' => $experience,
            'education' => $education,
            'publication' => $publication,
            'interest' => $interest,
            'skill' => $skill,
            'refree' => $refree
        ]);
    }

    public function indexProjectHome()
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

    // Home page
    public function indexHome()
    {
        // Header Image
        $home_setting1 = home_setting::find(1);
        // First Name
        $home_setting2 = home_setting::find(2);
        // Last Name
        $home_setting3 = home_setting::find(3);
        // Slogan
        $home_setting4 = home_setting::find(4);
        // Short Description
        $home_setting5 = home_setting::find(5);
        // Life Goals
        $home_setting6 = home_setting::find(6);
        // About Me
        $home_setting7 = home_setting::find(7);

        return view('home', [
            'home_setting1' => $home_setting1->value,
            'home_setting2' => $home_setting2->value,
            'home_setting3' => $home_setting3->value,
            'home_setting4' => $home_setting4->value,
            'home_setting5' => $home_setting5->value,
            'home_setting6' => $home_setting6->value,
            'home_setting7' => $home_setting7->value
        ]);
    }

    // Admin Page
    public function indexAdmin()
    {
        $user = auth()->user();
        return view('/adminHome');
    }

    // New Education Page
    public function newEducation()
    {
        return view('education.newEducation');
    }
    // Show Each Education
    public function indexEducation()
    {
        $education = Education::all();      
        return view('education/educationList', [
          'education' => $education,
        ]);
    }
    // Insert Education
    public function storeEducation()
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
    public function destroyEducation($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return redirect('education/educationList');
    }
    // Search Education
    public function searchEducation(Request $request)
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
    public function editEducation($id)
    {
        $education = Education::findOrFail($id);
        return view('education.editEducation',['education' => $education]);
    }
    // Update Education
    public function updateEducation($id)
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
    public function showEducation($id)
    {
        $education = Education::findOrFail($id);
        return view('education.eachEducation', ['education' => $education]);
    }
    // Insert publication
    public function newPublication()
    {
        return view('publication.newPublication');
    }
    // Store publication
    public function storePublication()
    {
        $public = new Publication();
        $public->title = request('Title');
        $public->desc = request('desc1');
        $public->desc2 = request('desc2');
        $public->desc3 = request('desc3');
        $public->desc4 = request('desc4');
        $public->desc5 = request('desc5');

        $public->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Show publication
    public function indexPublication()
    {
        $publication = Publication::all();      
        return view('publication/publicationList', [
          'publication' => $publication
        ]);
    }
    // Show each publication
    public function showPublication($id)
    {
        $publication = Publication::findOrFail($id);      
        return view('publication.eachPublication', [
          'publication' => $publication
        ]);
    }
    // Edit publication page
    public function editPublication($id)
    {
        $publication = Publication::findOrFail($id);      
        return view('publication.editPublication', [
          'publication' => $publication
        ]);
    }
    // Update publication 
    public function updatePublication($id)
    {
        $public = Publication::findOrFail($id);      
        $public->title = request('Title');
        $public->desc = request('desc1');
        $public->desc2 = request('desc2');
        $public->desc3 = request('desc3');
        $public->desc4 = request('desc4');
        $public->desc5 = request('desc5');

        $public->save();
        return redirect('/publication/publicationList');
    }
    public function destroyPublication($id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();
        return redirect('publication/publicationList');
    }
    // Search for publication
    public function searchPublication(Request $request)
    {   
        if(!empty($request->input('title')))
        {
            $title = $request->get('title');
            $publication = Publication::where('title','LIKE','%'.$title.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc1')))
        {
            $desc1 = $request->get('desc1');
            $publication = Publication::where('desc','LIKE','%'.$desc1.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc2')))
        {
            $desc2 = $request->get('desc2');
            $publication = Publication::where('desc2','LIKE','%'.$desc2.'%')->paginate(5);
            if(count($publication) > 0)
                return view('/publication/publicationList',['publication' => $publication]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Interest Page
    public function newInterest()
    {
        return view("interest.newInterest");
    }
    // Store Interest
    public function storeInterest(Request $request)
    {
        $interest = new Interest();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $interest->image = $file;
        }

        if($request->hasFile('image2'))
        {
            $image2 = $request->file('image2');
            $file2= rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $file2);
            $interest->image2 = $file2;
        }

        if($request->hasFile('image3'))
        {
            $image3 = $request->file('image3');
            $file3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $file3);
            $interest->image3 = $file3;
        }

        $interest->desc = request('desc');
        $interest->desc2 = request('desc2');
        $interest->desc3 = request('desc3');
        $interest->desc4 = request('desc4');

        $interest->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Interest Page
    public function indexInterest()
    {
        $interest = Interest::all();      
        return view('interest/interestList', [
          'interest' => $interest
        ]);
    }
    // Delete interest
    public function destroyInterest($id)
    {
        $interest = Interest::findOrFail($id);

        $imageDelete = public_path("images/$interest->image");
        if(File::exists($imageDelete))
        {
            File::delete($imageDelete); 
        }

        $imageDelete2 = public_path("images/$interest->image2");
        if(File::exists($imageDelete2))
        {
            File::delete($imageDelete); 
        }

        $imageDelete3 = public_path("images/$interest->image3");
        if(File::exists($imageDelete3))
        {
            File::delete($imageDelete); 
        }

        $imageDelete4 = public_path("images/$interest->image4");
        if(File::exists($imageDelete4))
        {
            File::delete($imageDelete); 
        }

        $interest->delete();
        return redirect('interest/interestList');
    }

    // Delete interest
    public function editInterest($id)
    {
        $interest = Interest::findOrFail($id);
        return view('interest/editInterest', [
            'interest' => $interest
        ]);
    }

    // Update interest
    public function updateInterest($id,Request $request)
    {
        $interest = Interest::findOrFail($id);
        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$interest->image");
            if(File::exists($imageDelete))
            {
                File::delete($imageDelete); 

            }

            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $interest->image = $file;
        }

        if($request->hasFile('image2'))
        {
            $imageDelete2 = public_path("images/$interest->image2"); // get previous image from folder
            if(File::exists($imageDelete2)) { // unlink or remove previous image from folder
                unlink($imageDelete2);
            }

            $image2 = $request->file('image2');
            $file2= rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $file2);
            $interest->image2 = $file2;
            
        }

        if($request->hasFile('image3'))
        {
            $imageDelete3 = public_path("images/$interest->image3"); // get previous image from folder
            if(File::exists($imageDelete3)) { // unlink or remove previous image from folder
                unlink($imageDelete3);
            }

            $image3 = $request->file('image3');
            $file3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $file3);
            $interest->image3 = $file3;
        }

        $interest->desc = request('desc');
        $interest->desc2 = request('desc2');
        $interest->desc3 = request('desc3');
        $interest->desc4 = request('desc4');
        $interest->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Show each interest
    public function showInterest($id)
    {
        $eachInterest = Interest::findOrFail($id);
        return view('interest.eachInterest', ['eachInterest' => $eachInterest]);
    }

    // Serach for Interest Table
    public function searchInterest(Request $request)
    {
        if(!empty($request->input('desc')))
        {
            $desc = $request->get('desc');
            $interest = Interest::where('desc','LIKE','%'.$desc.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc2')))
        {
            $desc2 = $request->get('desc2');
            $interest = Interest::where('desc2','LIKE','%'.$desc2.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('desc3')))
        {
            $desc3 = $request->get('desc3');
            $interest = Interest::where('desc3','LIKE','%'.$desc3.'%')->paginate(5);
            if(count($interest) > 0)
                return view('/interest/interestList',['interest' => $interest]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        else{
            return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // new Skill Page
    public function newSkill()
    {
        return view('skill.newSkill');
    }

    // store Skill
    public function storeSkill(Request $request)
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
    public function indexSkill()
    {
        $skill = Skill::all();      
        return view('skill/skillList', [
          'skill' => $skill
        ]);
    }

    // Show Each Skill
    public function destroySkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect('skill/skillList');
    }

    // Edit Skill
    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        return view('skill/editSkill', [
            'skill' => $skill
        ]);
    }

    // Update Skill
    public function updateSkill($id)
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
    public function showSkill($id)
    {
        $eachSkill = Skill::findOrFail($id);
        return view('skill.eachSkill', ['eachSkill' => $eachSkill]);
    }
    // Search in Skill
    public function searchSkill(Request $request)
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
   
    //Logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('login/login');
    }

    // login
    public function indexLogin()
    {
        return view('login.login');
    }

    // Store Login
    public function storeLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
     
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/adminHome');
        }
        return back()->with('faliure', 'Your password is incorrect.please try again');
    }


    // Home Setting Information
    public function indexSetting(Request $request)
    {
        // Header Image
        $home_setting1 = home_setting::find(1);
        // First Name
        $home_setting2 = home_setting::find(2);
        // Last Name
        $home_setting3 = home_setting::find(3);
        // Slogan
        $home_setting4 = home_setting::find(4);
        // Short Description
        $home_setting5 = home_setting::find(5);
        // Life Goals
        $home_setting6 = home_setting::find(6);
        // About Me
        $home_setting7 = home_setting::find(7);

        return view('setting/homeSetting', [
            'home_setting1' => $home_setting1->value,
            'home_setting2' => $home_setting2->value,
            'home_setting3' => $home_setting3->value,
            'home_setting4' => $home_setting4->value,
            'home_setting5' => $home_setting5->value,
            'home_setting6' => $home_setting6->value,
            'home_setting7' => $home_setting7->value
        ]);
    }

    // Update Home Setting
    public function updateSetting(Request $request)
    {
        // Header Image
        $home_setting1 = home_setting::findOrFail(1);
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $home_setting1->value = $file;
            $home_setting1->save();
        }
        // First Name
        $home_setting2 = home_setting::find(2);
        $home_setting2->value = $request->get('first_name');
        $home_setting2->save();
        // Last Name
        $home_setting3 = home_setting::find(3);
        $home_setting3->value = $request->get('last_name');
        $home_setting3->save();
        // Slogan
        $home_setting4 = home_setting::find(4);
        $home_setting4->value = $request->get('slogan');
        $home_setting4->save();
        // Short Description
        $home_setting5 = home_setting::find(5);
        $home_setting5->value = $request->get('short_desc');
        $home_setting5->save();
        // Life Goals
        $home_setting6 = home_setting::find(6);
        $home_setting6->value = $request->get('life_goals');
        $home_setting6->save();
        // About Me
        $home_setting7 = home_setting::find(7);
        $home_setting7->value = $request->get('about_me');
        $home_setting7->save();

        return back()->with('success', 'You have successfully sumbitted data');
    }

    
  
    
    // // Getting Email from User
    // public function storeEmail()
    // {
    //     $data = request()->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'message' => 'required'
    //     ]);
    //     // Send An Email
    //     Mail::to('aba7bb255e-dd51c1@inbox.mailtrap.io')->send(new ContactFormMail($data));
    //     return back()->with('success', 'You have successfully sumbitted data'); 
    // }

}