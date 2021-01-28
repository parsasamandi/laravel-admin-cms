<?php

namespace App\Models;
use App\Models\Description;

use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    public $timestamps = false;
    protected $table = 'link'; 

    public function description()
    {
        return $this->belongsTo(Description::class,'desc_id');
    }
}
