<?php

namespace App;
use App\Description;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    protected $table = 'experience';

    public function description()
    {
        return $this->hasMany(Description::class,'experience_id','id');
    }
}
