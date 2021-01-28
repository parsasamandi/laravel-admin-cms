<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\DataTables\AdminDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Admin Table
    public function list() {
        // DataTable
        $dataTable = new AdminDataTable();

        // Admin Table
        $vars['adminTable'] = $dataTable->html();

        return view('adminList', $vars);
    }

    // Get Admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('adminList');
    }

    // Store Admin
    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'nullable|min:6',
            'password2' => 'same:password',
            'email' => 'email|unique:users, email,' . $request->get('email')
        ]);

        $error_array = array();
        $success_output = '';
        
        // Validation
        if($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        }
        else {
            // Insert
            if($request->get('#button_action') == "insert") {
                $this->newAdmin($request);
                $success_output = '<div class="alert alert-success">The data is submitted successfully</div>';
            }
            // Update
            else if($request->get('#button_action') == "update") {
                $this->newAdmin($request);
                $success_output = '<div class="alert alert-success">The data is updated successfully</div>';
            }
        }
        $output = array(
            'error' => $error_array,
            'success' => $success_output
        );

        return json_encode($output);
    }

    // Add Or Update Admin
    public function addAdmin($request) {
        // Edit
        $admin = User::find($request->get('id'));
        if(!$admin) {
            // Insert
            $admin = new User();
        }
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        if($request->get('password') != 'رمز عبور جدید' and $request->get('password') != 'تکرار رمز عبور جدید') {
            $admin->password = Hash::make($request->get('password'));
        }

        $admin->save();
    }

    // Delete Each Admin
    public function delete(Request $request, $id) {
        $admin = User::find($id);
        if($admin) {
            $admin->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit Admin
    public function edit(Request $request) {
        $admin = User::findOrFail($request->get('id'));
        return json_encode($admin);
    }

    // AdminHome
    public function adminHome() {
        return view('adminHome');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('login/login');
    }
    
    
}
