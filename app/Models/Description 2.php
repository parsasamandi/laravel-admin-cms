<?php

namespace App\Models;
use App\Project;
use App\Link;
use App\Experience;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public $timestamps = false;
    protected $table = 'description';

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','project_id');
    }
    public function link()
    {
        return $this->hasMany(Link::class,'desc_id');
    }
    public function media()
    {
        return $this->hasOne(Media::class,'desc_id');
    }
    public function getLink()
    {
        return Link::where('desc_id',$this->id)->select('link')->get();
    }
    public function experience()
    {
        return $this->belongsTo(Experience::class,'experience_id','id');
    }

}
