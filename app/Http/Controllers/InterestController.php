<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\DataTables\InterestDataTable;
use App\Http\Requests\StoreInterestRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Interest;
use App\Models\Media;

class InterestController extends Controller
{
    public $interest = '\App\Models\Interest';

    // Interest Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new InterestDataTable();

        $vars['interestTable'] = $dataTable->html();

        // Media
        $medias = Media::select('id','media_url')->get();

        return view('interestList', $vars, compact('medias'));
    }

    public function interestTable(InterestDataTable $dataTable) {
        return $dataTable->render('interestList');
    }

    // Store Interest
    public function store(StoreInterestRequest $request,SuccessMessages $message)
    {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addInterest($request);
            $success_output = $message->getInsert();
        }
        else if($request->get('button_action') == "update") {
            $this->addInterest($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);
    }

    public function addInterest($request) {
        // Edit
        $interest = Interest::find($request->get('id'));
        if(!$interest) {
            // Insert
            $interest = new Interest();
        }
        $interest->title = $request->get('title');
        $interest->media_id = $request->get('imageBox');

        $interest->save();
    }

    // Delete Interest
    public function delete(Action $action,Request $request) {
        return $action->delete($this->interest,$request->get('id'));
    }

    // Edit interest
    public function edit(Action $action,Request $request) {
        return $action->edit($this->interest,$request->get('id'));
    }
    
}
