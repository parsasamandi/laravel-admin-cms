<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\PublicationDataTable;
use App\Http\Requests\StorePublicationRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\ Publication;


class PublicationController extends Controller
{
    public $publication = '\App\Models\Publication';
    // Publication Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new PublicationDataTable();

        $vars['publicationTable'] = $dataTable->html();

        return view('publicationList', $vars);
    }
    // DataTable
    public function publicationTable(PublicationDataTable $dataTable) {
        return $dataTable->render('publicationList');
    }

    // Store Publication
    public function store(StorePublicationRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == "insert") {
            $this->addPublication($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $this->addPublication($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return json_encode($output);
    }

    // Add Or Update Publication
    public function addPublication($request) {
        // Edit
        $publication = Publication::find($request->get('id'));
        if(!$publication) {
            // Insert
            $publication = new Publication();
        }
        $publication->title = $request->get('title');   
        $publication->save();
    }
    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit($this->publication,$request->get('id'));
    }
    // Delete
    public function delete(Action $action,$id) {
        return $action->delete($this->publication,$id);
    }
}
