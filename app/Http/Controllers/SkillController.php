<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreSkillRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\DataTables\SkillDataTable;
use App\Models\Refree;
use App\Models\Experience;
use App\Models\Skill;

class SkillController extends Controller
{
    public $skill = '\App\Models\Skill';

    // Skill Table
    public function list(Request $request) {
        // DataTable
        $dataTable = new SkillDataTable();

        $vars['skillTable'] = $dataTable->html();

        return view('skillList', $vars);
    }
    // DataTable
    public function skillTable(SkillDataTable $dataTable) {
        return $dataTable->render('skillList');
    }

    // Store Skill
    public function store(StoreSkillRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == "insert") {
            $this->addSkill($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $this->addSkill($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return json_encode($output);
    }

    // Add Or Update Skill
    public function addSkill($request) {
        // Edit
        $skill = Skill::find($request->get('id'));
        if(!$skill) {
            // Insert
            $skill = new Skill();
        }
        $skill->title = $request->get('title');   
        $skill->save();
    }
    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit($this->skill,$request->get('id'));
    }
    // Delete
    public function delete(Action $action,$id) {
        return $action->delete($this->skill,$id);
    }
}
