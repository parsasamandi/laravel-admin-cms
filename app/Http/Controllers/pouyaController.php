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

    // Home page
    public function indexHome()
    {
        // Header Image
        $home_setting1 = homeSetting::find(1);
        // First Name
        $home_setting2 = homeSetting::find(2);
        // Last Name
        $home_setting3 = homeSetting::find(3);
        // Slogan
        $home_setting4 = homeSetting::find(4);
        // Short Description
        $home_setting5 = homeSetting::find(5);
        // Life Goals
        $home_setting6 = homeSetting::find(6);
        // About Me
        $home_setting7 = homeSetting::find(7);

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