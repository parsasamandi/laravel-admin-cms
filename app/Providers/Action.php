<?php

namespace App\Providers;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Media;
use File;

class Action {

    /**
     * Edit
     * 
     * @return json
     */
    public function edit($model, $id) {
        try {
            $values = $model::find($id);

            return $values ? response()->json($values) 
                : $this->failedResponse();

        } catch (Throwable $e) {
            return response()->json($e);
        }
    }

    /**
     * Delete
     * 
     * @return json
     */
    public function delete($model, $id) {

        $values = $model::find($id);

        return $values ? $values->delete()
                : $this->failedResponse();
    }

    // Response with error
    public function failedResponse() {
        return response()->json(['error' => 'No data was found'], Response::HTTP_NOT_FOUND);
    }
}

?>