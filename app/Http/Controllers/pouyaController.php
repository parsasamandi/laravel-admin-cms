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
use App\HomeSetting;
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

    // login
    public function indexLogin()
    {
        return view('login.login');
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