<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    public $timestamps = false;
    protected $table = 'sub_project';

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','project_id');
    }
}
