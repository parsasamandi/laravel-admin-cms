<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $degree
 * @property string $GPA
 * @property string $TOEFL
 * @property string $Thesis_topic
 * @property string $education_period
 * @property string $university_desc
 */
class Education extends Model
{
    public $tmp = false;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'degree', 'GPA', 'TOEFL', 'Thesis_topic', 'education_period', 'university_desc'];

}
