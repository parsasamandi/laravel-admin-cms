<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property Description[] $descriptions
 */
class Experience extends Model
{
    public $tmp = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'experience';

    /**
     * @var array
     */
    protected $fillable = ['title', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descriptions()
    {
        return $this->hasMany('App\Models\Description');
    }
}
