<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;
use App\DataTables\UserDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Providers\Action;
use App\Models\User;

class UserController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }
    
    // Admin page
    public function show() {
        return view('user.home');
    }

    // DataTable to blade
    public function list() {

        $dataTable = new UserDataTable();

        // User Table
        $vars['userTable'] = $dataTable->html();
 
        return view('user.list', $vars);
    }

    // Get user
    public function userTable(UserDataTable $dataTable) {
        return $dataTable->render('user.list');
    }

    // Store user
    public function store(StoreUserRequest $request) {
        // Id
        $id = $request->get('id');

        User::updateOrCreate(
            ['id' => $id],
            ['name' => $request->get('name'),'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'phone_number' => $request->get('phone_number')]
        );

        return $this->getAction($request->get('button_action'));
    }
    
    // Edit 
    public function edit(Request $request) {
        return $this->action->edit(User::class, $request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->delete(User::class, $id);
    }
}
