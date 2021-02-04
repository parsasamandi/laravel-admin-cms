<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\Action;
use App\Http\Requests\StoreRefreeRequest;
use App\Providers\SuccessMessages;
use App\DataTables\RefreeDataTable;
use App\Models\Refree;
use App\Models\Experience;
use File;

class RefreeController extends Controller
{
    // Refree Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new RefreeDataTable();

        $vars['refreeTable'] = $dataTable->html();

        return view('refreeList', $vars);
    }

    // DataTable
    public function refreeTable(RefreeDataTable $dataTable) {
        return $dataTable->render('refreeList');
    }
    
    // Store Refree
    public function store(StoreRefreeRequest $request,SuccessMessages $success) {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addRefree($request);
            $success_output = $success->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $this->addRefree($request);
            $success_output = $success->getUpdate();
        }

        $output = ['success' => $success_output];

        return json_encode($output);
    }

    // store new Refree
    public function addRefree($request) {
        // Edit
        $refree = Refree::find($request->get('id'));
        if(!$refree) {
            // Insert
            $refree = new Refree();
        }
        $refree->name = $request->get('name');
        $refree->desc = $request->get('desc');
        $refree->link = $request->get('link');

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file= rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $file);
            $refree->image = $file;
        }

        $refree->save();
    }

    // Edit Refree
    public function edit(Action $action,Request $request)
    {
        return $action->edit('\App\Models\Refree',$request->get('id'));
    }

    // Delete Refree
    public function delete($id) {
        $refree = Refree::findOrFail($id);
        if($refree) {
            $imageDelete = public_path("images/$refree->image");
            if(File::exists($imageDelete)) {
                File::delete($imageDelete); 
            }
            $refree->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);

    }

  
    
    
}
