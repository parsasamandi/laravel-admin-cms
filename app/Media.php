<?php

namespace App;
use App\Project;
use App\Media_text;
use App\Description;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public $timestamps = false;
    protected $table = 'media';

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','project_id');
    }

    public function getProject()
    {
        return Project::where('project_id',$this->project_id)->select('name')->first();
    }

    public function mediaTextRel()
    {
        return $this->belongsTo(Media_text::class,'mediaText_id','id');
    }

    public function getMediaText()
    {
        return Media_text::where('id',$this->mediaText_id)->get();
    }

    public function description()
    {
        return $this->belongsTo(Description::class,'desc_id','id');
    }
}
