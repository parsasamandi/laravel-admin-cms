<?php

namespace App\Models;
use App\Models\Description;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    public $timestamps = false;

    protected $table = 'experience';

    public function description() {
        return $this->hasMany(Description::class);
    }
}
