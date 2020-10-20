<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Admin;

class AdminController extends Controller
{
   
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
    
}
