<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\homeSetting;

class SettingController extends Controller
{
   
   // Home Setting Information
   public function index(Request $request)
   {
       $names = [
           'image',
           'first_name',
           'last_name',
           'slogan',
           'short_desc',
           'life_goals',
           'about_me'
       ];

       $home_settings = homeSetting::whereIn('name',$names)->get();
       $vars = [];
       foreach($home_settings as $setting)
       {
           $vars["setting_$setting->name"] = $setting->value;
       }

       return view('setting.homeSetting', $vars);
   }

    // Update Home Setting
    public function update(Request $request)
    {
        // Header Image
        $setting_image = homeSetting::where('name','image')->first();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
            $setting_image->value = $file;
            $setting_image->save();
        }
        // First Name
        $setting_first_name = homeSetting::where('name','first_name')->first();
        $setting_first_name->value = $request->get('first_name');
        $setting_first_name->save();
        // Last Name
        $setting_last_name = homeSetting::where('name','last_name')->first();
        $setting_last_name->value = $request->get('last_name');
        $setting_last_name->save();
        // Slogan
        $setting_slogan = homeSetting::where('name','slogan')->first();
        $setting_slogan->value = $request->get('slogan');
        $setting_slogan->save();
        // Short Description
        $setting_short_desc = homeSetting::where('name','short_desc')->first();
        $setting_short_desc->value = $request->get('short_desc');
        $setting_short_desc->save();
        // Life Goals
        $setting_life_goals = homeSetting::where('name','life_goals')->first();
        $setting_life_goals->value = $request->get('life_goals');
        $setting_life_goals->save();
        // About Me
        $setting_about_me = homeSetting::where('name','about_me')->first();
        $setting_about_me->value = $request->get('about_me');
        $setting_about_me->save();

        return back()->with('success', 'You have successfully sumbitted data');
    }
  

    
    
}
