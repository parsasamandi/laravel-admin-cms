<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Get action
    public function getAction($action) {
        // Insert
        if($action == "insert") {
            $success_output = $this->getInsertionMessage();
        }
        // Update
        else if($action == 'update') {
            $success_output = $this->getUpdateMessage();
        }
        
        return response()->json(['success' => true, 'message' => $success_output], Response::HTTP_CREATED); 
    }

    // Get success message
    public function getInsertionMessage() {
        return '<div class="alert alert-success">The data has been submitted successfully</div>';
    }

    // Get update message
    public function getUpdateMessage() {
        return '<div class="alert alert-success">The data has been updated successfully</div>';
    }
}
