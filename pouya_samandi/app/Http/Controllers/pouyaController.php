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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactFormMail;
use DB;


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

    // new Experience page
    public function newExperience(Request $request)
    {
        return view('/experience/newExperience');
    }
    // Insert Experience
    public function storeExperience(Request $request)
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
    public function indexExperience() {
        $experience = Experience::all();      
        return view('experience/experienceList', [
          'experience' => $experience,
        ]);
    }   
    // Search for experience
    public function searchExperience(Request $request)
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
    public function destroyExperience($id)
    {
        $experience = Experience::findOrFail($id);
    
        $imageDelete = public_path("images/$experience->image");
        if(File::exists($imageDelete))
        {
            unlink($imageDelete);
        }
        $experience->delete();
        return redirect('experience/experienceList');
    }
    // Show Each Experience
    public function showExperience($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experience.eachExperience', ['experience' => $experience]);
    }
    // Edit Experience Page
    public function editExperience($id)
    {
        $experience = Experience::findOrFail($id);
        return view('experience.editExperience', ['experience' => $experience]);
    }
    // update Experience
    public function updateExperience($id,Request $request)
    {
        $exper = Experience::findOrFail($id);
        $exper->title = request('Title');

        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$exper->image");
            if(File::exists($imageDelete))
            {
                unlink($imageDelete);
            }
            
            $image = request('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $exper->image = $file;
        }

        $exper->save();
        return redirect('experience/experienceList');
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
            unlink($imageDelete);
        }

        $imageDelete2 = public_path("images/$interest->image2");
        if(File::exists($imageDelete2))
        {
            unlink($imageDelete2);
        }

        $imageDelete3 = public_path("images/$interest->image3");
        if(File::exists($imageDelete3))
        {
            unlink($imageDelete3);
        }

        $imageDelete4 = public_path("images/$interest->image4");
        if(File::exists($imageDelete4))
        {
            unlink($imageDelete4);
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
                unlink($imageDelete);
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
    // new Refree Page
    public function newRefree()
    {
        return view('refree.newRefree');
    }
    // store new Refree
    public function storeRefree(REquest $request)
    {
        $refree = new Refree();
        $refree->name = request('name');
        $refree->desc = request('desc');
        $refree->link = request('link');
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $refree->image = $file;
        }

        $refree->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Show Refree
    public function indexRefree(REquest $request)
    {
        $refree = Refree::all();
        return view('refree/refreeList', [
            'refree' => $refree
          ]);
    }

    // Delete Refree
    public function destroyRefree($id)
    {
        $refree = Refree::findOrFail($id);
        
        $imageDelete = public_path("images/$refree->image");
        if(File::exists($imageDelete))
        {
            unlink($imageDelete);
        }

        $refree->delete();
        return redirect('refree/refreeList');
    }

    // Show refree
    public function showRefree($id)
    {
        $refree = Refree::findOrFail($id);
        return view('refree.eachRefree', ['eachRefree' => $refree]);
    }

    // Edit refree
    public function editRefree($id)
    {
        $refree = Refree::findOrFail($id);
        return view('refree.editRefree', ['eachRefree' => $refree]);
    }

    // Update refree
    public function updateRefree($id,Request $request)
    {
        $refree = Refree::findOrFail($id);
        $refree->name = request('name');
        $refree->desc = request('desc');
        $refree->link = request('link');
        if($request->hasFile('image'))
        {
            $imageDelete = public_path("images/$refree->image"); // get previous image from folder
            if(File::exists($imageDelete)) { // unlink or remove previous image from folder
                unlink($imageDelete);
            }
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $refree->image = $file;
        }

        $refree->save();
        return redirect('refree/refreeList');
    }

     // Search for refree
     public function searchRefree(Request $request)
     {
         if(!empty($request->input('name')))
         {
             $name = $request->get('name');
             $refree = Refree::where('name','LIKE','%'.$name.'%')->paginate(5);
             if(count($refree) > 0)
                 return view('/refree/refreeList',['refree' => $refree]);
             else 
                 return back()->with('faliure', 'There were no results. please try again');
         }
         if(!empty($request->input('desc')))
         {
             $desc = $request->get('desc');
             $refree = Refree::where('desc','LIKE','%'.$desc.'%')->paginate(5);
             if(count($refree) > 0)
                 return view('/refree/refreeList',['refree' => $refree]);
             else 
                 return back()->with('faliure', 'There were no results. please try again');
         }
     }
    //logout
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

    // New Admin
    public function newAdmin(Request $request)
    {  
        return view('admin.newAdmin');
    }

    // Store Admin
    public function storeAdmin(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Admin List
    public function indexAdmin2(Request $request)
    {
        $admin = User::all();
        return view('admin/adminList', [
            'admin' => $admin
        ]);
    }

    // Deleting Admin
    public function destroyAdmin($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect('admin/adminList');
    }

    // Edit Admin
    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.editAdmin', ['admin' => $admin]);
    }

    // Update Admin
    public function updateAdmin($id,Request $request)
    {
        $admin = User::findOrFail($id);
        $admin->name = $request['name'];
        $admin->email = $request['email'];
        if($request['password'] == $request['password2'])
        {
            $admin->password = Hash::make($request['password']);
        }
        $admin->save();
        return redirect('admin/adminList');
    }

    // Search for Admin
    public function searchAdmin(Request $request)
    {
        if(!empty($request->input('name')))
        {
            $name = $request->get('name');
            $user = User::where('name','LIKE','%'.$name.'%')->paginate(5);
            if(count($user) > 0)
            return view('/admin/adminList',['user' => $user]);
            else 
            return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('email')))
        {
            $email = $request->get('email');
            $user = User::where('email','LIKE','%'.$email.'%')->paginate(5);
            if(count($user) > 0)
            return view('/admin/adminList',['user' => $user]);
            else 
            return back()->with('faliure', 'There were no results. please try again');
        }
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

    // New Description Page
    public function newDescription(Request $request)
    {
        $project = Project::select('name','project_id')->get();
        $experience = Experience::select('title','id')->get();
        return view('description/newDescription',[
            'project' => $project,
            'experience' => $experience
        ]);
    }

    // Store Description
    public function storeDescription(Request $request)
    {
        $description = new Description();
        $description->desc = request('desc1');
        if(!(request('projectBox') == 'project_name'))
        {
            $description->project_id = request('projectBox');
        }
        else if(request('projectBox') == 'project_name')
        {
            $description->project_id = null;
        }
        if(!(request('experienceBox') == 'experience_url'))
        {
            $description->experience_id = request('experienceBox');
        }
        else if(request('experienceBox') == 'experience_url')
        {
            $description->experience_id = null;
        }

        $description->size = request('size');
        $description->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }

    // Description List
    public function indexDescription(Request $request)
    {
        $desc = Description::all();
        return view('description/descriptionList', [
            'desc' => $desc
        ]);
    }

    // New Project Page
    public function newProject()
    {
        return view('project/newProject');
    }

    // New Project Page
    public function storeProject(Request $request)
    {
        $project = new Project();
        $project->name = request('name');
        $project->background_color = request('background');
        $project->section_id = request('section_id');

        $project->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Edit Project Page
    public function editProject($id)
    {
        $project = Project::where('project_id', $id)->first();
        return view('project.editProject', ['project' => $project]);
    }
    // Update Project Page
    public function updateProject($id,Request $request)
    {

        Project::where('project_id', $id)->update(array(
            'name' => request('name'),
            'background_color' => request('background'),
            'section_id' => request('section_id'),
        ));
        return redirect('project/projectList');
    }
    // Delete Project
    public function destroyProject($id)
    {
        $project = Project::where('project_id', $id);
        $project->delete();

        return redirect('project/projectList');
    }
    // Delete Project
    public function searchProject(Request $request)
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
    public function indexProject()
    {
        $project = Project::all();
        return view('project/projectList',[
            'project' => $project
        ]);
    }
    // Delete Description
    public function destroyDescription($id)
    {
        $desc = Description::where('id', $id);
        $desc->delete();

        return redirect('/description/descriptionList');
    }

    // Search for Description
    public function searchDescription(Request $request)
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
    public function editDescription($id)
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
    public function updateDescription($id)
    {
        $description = Description::findOrFail($id);
        $description->desc = request('desc1');

        if(!(request('projectBox') == 'project_name'))
        {
            $description->project_id = request('projectBox');
        }
        else if(request('projectBox') == 'project_name')
        {
            $description->project_id = null;
        }
        if(!(request('experienceBox') == 'experience_url'))
        {
            $description->experience_id = request('experienceBox');
        }
        else if(request('experienceBox') == 'experience_url')
        {
            $description->experience_id = null;
        }

        $description->size = request('size');

        $description->save();

        return redirect('description/descriptionList');
    }

    // Media Page
    public function newMedia()
    {
        $media_text = DB::table('media_text')->select('mediaText','id')->get();
        $projects = DB::table('project')->select('name','project_id')->get();
        $description = Description::all();
        return view('media.newMedia',[
            'media_text' => $media_text,
            'projects' => $projects,
            'description' => $description
        ]);
    }
    // Show All Media
    public function indexMedia()
    {
        $media = Media::all();
        return view('media/mediaList', [
            'media' => $media,
        ]);
    }

    // Store Media
    public function storeMedia(Request $request)
    {
        
        // $rules = array(
        //     'mediaTextBox' => 'required_without_all:image,youtube_url,descriptionBox',
        //     'descriptionBox' => 'required_without_all:image,youtube_url,mediaTextBox'
        // );
        // $validator = Validator::make($request->all(), $rules);

        $media = new Media();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $media->media_url = $file;
            $media->type = 0;
        }
        else if(!empty($request->input('youtube_url')))
        {
            $media->type = 1;
            $media->media_url = request('youtube_url');
        }
        if(!(request('descriptionBox') == 'description_null'))
        {
            $media->desc_id = request('descriptionBox');
        }
        else if(request('descriptionBox') == 'description_null')
        {
            $media->desc_id = null;
        }
        if(!(request('mediaTextBox') == 'mediaText_null'))
        {
            $media->mediaText_id = request('mediaTextBox');
        }
        else if(request('mediaTextBox') == 'mediaText_null')
        {
            $media->mediaText_id = null;
        }

        if(!(request('projectBox') == 'project_null'))
        {
            $media->project_id = request('projectBox');
            $media->twoInRow = 1;
        }
        else if(request('projectBox') == 'project_null')
        {
            $media->project_id = null;
        }

        $media->save();
        return back()->with('success', 'You have successfully sumbitted data');
    }
    // Each Media
    public function editMedia($id)
    {
        $media = Media::where('id', $id)->first();
        $media_text = media_text::all();
        $description = Description::select('desc','id')->get();
        $project = DB::table('project')->select('name','project_id')->get();
        return view('media.editMedia', [
            'media' => $media,
            'media_text' => $media_text,
            'projects' => $project,
            'description' => $description
        ]);
    }
    // Update Media
    public function updateMedia($id,Request $request)
    {
        $media = Media::findOrFail($id);
        if($request->hasFile('image'))
        {
            if($media->type == 0)
            {
                $imageDelete = public_path("images/$media->media_url");
                if(File::exists($imageDelete))
                {
                    unlink($imageDelete);
                }
            }

            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $media->media_url = $file;
            // Image File
            $media->type = 0;
        }
        else if(!empty($request->input('youtube_url')))
        {
            // Yotube Embeded Link
            $media->type = 1;
            $media->media_url = request('youtube_url');
        }
        if(!(request('descriptionBox') == 'description_null'))
        {
            $media->desc_id = request('descriptionBox');
        }
        else if(request('descriptionBox') == 'description_null')
        {
            $media->desc_id = null;
        }
        if(!(request('mediaTextBox') == 'mediaText_null'))
        {
            $media->mediaText_id = request('mediaTextBox');
        }
        else if(request('mediaTextBox') == 'mediaText_null')
        {
            $media->mediaText_id = null;
        }
        if(!(request('projectBox') == 'project_null'))
        {
            $media->project_id = request('projectBox');
        }
        else if(request('projectBox') == 'project_null')
        {
            $media->project_id = null;
        }

        $media->save();
        return redirect('media/mediaList');
    }
    // Search For Media
    public function searchMedia(Request $request)
    {
        if(!empty($request->input('media_url')))
        {
            $media_hw = $request->get('media_hw');
            $media = Media::where('height','LIKE','%'.$media_hw.'%')->orWhere('width', 'LIKE', '%'.$media_hw.'%')->paginate(5);
            if(count($media) > 0)
                return view('/media/mediaList',['media' => $media]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // Delete Media
    public function destroyMedia($id)
    {
        $media = Media::findOrFail($id);
        if($media->type == 0)
        {
            $imageDelete = public_path("images/$media->media_url");
            if(File::exists($imageDelete))
            {
                unlink($imageDelete);
            }
        }
        $media->delete();


        return redirect('/media/mediaList');
    }
    // Media Text Page
    public function newMediaText()
    {
        $media = DB::table('media')->select('media_url')->get();
        return view('media.newMediaText', ['media' => $media]);
    }
    // Store Media Text
    public function storeMediaText()
    {
        $media_text = new Media_text();
        $media_text->mediaText = request('media_text');

        $media_text->save();
        return back()->with('success', 'You have successfully sumbitted data'); 
    }

    // Media Text List
    public function indexMediaText()
    {
        $mediaText = Media_text::all();
        return view('media/mediaTextList', [
            'mediaText' => $mediaText
        ]);
    }

    // Edit Media Text Page
    public function editMediaText($id)
    {
        $mediaText = Media_text::where('id', $id)->first();
        return view('media/editMediaText',[
            'mediaText' => $mediaText
        ]);
    }
    // Update Media Text
    public function updateMediaText($id)
    {
        $mediaText = Media_text::where('id', $id)->update(array(
            'mediaText' => request('media_text')
        ));

        return redirect('media/mediaTextList');
    }

    // Delete Media Text
    public function destroyMediaText($id)
    {
        $media = Media_text::where('id', $id);
        $media->delete();

        return redirect('media/mediaTextList');
    }
    // Search For Media
    public function searchMediaText(Request $request)
    {
        if(!empty($request->input('media_text')))
        {
            $media_text = $request->get('media_text');
            $media = Media_text::where('mediaText','LIKE','%'.$media_text.'%')->paginate(5);
            if(count($media) > 0)
                return view('/media/mediaTextList',['mediaText' => $media]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }
    // New Link Page
    public function newLink()
    {
        $desc = Description::all();
        return view('link.newLink',[
            'desc' => $desc
        ]);
    }
    // Stroing Link
    public function storeLink()
    {
        $link = new Link();
        $link->text = request('text');
        $link->link = request('link');

        $link->desc_id = request('descriptionBox');

        $link->save();
        return back()->with('success', 'You have successfully sumbitted data'); 
    }
    // Storing Link
    public function indexLink()
    {
        $link = Link::all();
        return view('link/linkList', [
            'link' => $link
        ]);
    }
    // Edit Link Page
    public function editLink($id)
    {
        $desc = Description::all();
        $link = Link::where('id', $id)->first();
        return view('link/editLink', [
            'link' => $link,
            'desc' => $desc,
        ]);
    }

    // Edit Link Page
    public function updateLink($id)
    {
        Link::where('id', $id)->update(array(
            'text' => request('text'),
            'link' => request('link'),
            'desc_id' => request('descriptionBox')
        ));

        return redirect('link/linkList');
    }

    // Delete Link
    public function destroyLink($id)
    {
        $link = Link::where('id', $id);
        $link->delete();

        return redirect('link/linkList');
    }

    // Search For Link
    public function searchLink(Request $request)
    {
        if(!empty($request->input('link')))
        {
            $link_column = $request->get('link');
            $link = Link::where('link','LIKE','%'.$link_column.'%')->paginate(5);
            if(count($link) > 0)
                return view('/link/linkList',['link' => $link]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
        if(!empty($request->input('text')))
        {
            $text = $request->get('text');
            $link = Link::where('text','LIKE','%'.$text.'%')->paginate(5);
            if(count($link) > 0)
                return view('/link/linkList',['link' => $link]);
            else 
                return back()->with('faliure', 'There were no results. please try again');
        }
    }

    // New Project TItle Page
    public function newProjectTitle(Request $request)
    {   
        $project = DB::table('project')->select('name','project_id')->get();
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
    // Destroy Project
    public function destroyProjectTitle($id)
    {
        $projectTitle = SubProject::where('id', $id);
        $projectTitle->delete();

        return redirect('/project/projectTitleList');
    }
    // Getting Email from User
    public function storeEmail()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        // Send An Email
        Mail::to('aba7bb255e-dd51c1@inbox.mailtrap.io')->send(new ContactFormMail($data));
        return back()->with('success', 'You have successfully sumbitted data'); 
    }

}