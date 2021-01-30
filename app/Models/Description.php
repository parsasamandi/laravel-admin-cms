<?php

namespace App\Models;
use App\Models\Project;
use App\Models\Link;
use App\Models\Experience;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public $timestamps = false;
    protected $table = 'description';

    // Project Relation
    public function project() {
        return $this->belongsTo(Project::class);
    }
    // Link Relation
    public function link() {
        return $this->hasMany(Link::class);
    }
    // Media Relation
    public function media() {
        return $this->hasOne(Media::class,'desc_id');
    }
    public function getLink() {
        return Link::where('desc_id',$this->id)->select('link')->get();
    }
    public function experience() {
        return $this->belongsTo(Experience::class);
    }

}
