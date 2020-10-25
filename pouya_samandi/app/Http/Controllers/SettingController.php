<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\home_setting;

class SettingController extends Controller
{
   
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
  

    
    
}
