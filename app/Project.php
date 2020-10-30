<?php

namespace App;
use App\Media;
use App\Description;
use DB;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'project_id';
    protected $table = 'project';

    public function media()
    {
        return $this->hasMany(Media::class,'project_id','project_id');
    }

    public function getMedia()
    {
        return Media::with('project')->where('oneInRow',1);
    }

    public function description()
    {
        return $this->hasMany(Description::class,'project_id','project_id');
    }
    public function sub_project()
    {
        return $this->hasMany(SubProject::class,'project_id');
    }
    public function getDescription()
    {
        $projects = Project::all();
        foreach($projects as $project)
        {
            foreach($project->description as $description)
            {
                return $description->desc;
            }

        }
    }
    public function getDescription2()
    {
        $projects = Project::all();
        foreach($projects as $project)
        {
            foreach($project->description as $description)
            {
                return $description->desc2;
            }

        }
    }





}
