<?php

namespace App;
namespace App\Education;

use Illuminate\Database\Eloquent\Model;

class Universities extends Model
{
    public $timestamps = false;
    protected $table = 'university_rankings';
    public function Education()
    {
        return $this->belongsTo(Education::class,'id','id');
    }
}
