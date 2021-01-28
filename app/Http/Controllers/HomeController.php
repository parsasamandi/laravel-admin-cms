<?php

namespace App\Http\Controllers;

use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    // Home page
    public function index()
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

        return view('home',$vars);
    }
    
}
