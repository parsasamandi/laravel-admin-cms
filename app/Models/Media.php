<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $desc_id
 * @property int $project_id
 * @property string $media_url
 * @property int $type
 * @property int $mediaText_id
 * @property int $twoInRow
 * @property Description $description
 * @property MediaText $mediaText
 * @property Project $project
 * @property Interest[] $interests
 */
class Media extends Model
{
    const IMAGE = 0;
    const VIDEO = 1;

    public $timestamps = false;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'media';

    /**
     * @var array
     */
    protected $fillable = ['desc_id', 'project_id', 'media_url', 'type', 'mediaText_id', 'twoInRow'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function description()
    {
        return $this->belongsTo('App\Models\Description', 'desc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mediaText()
    {
        return $this->belongsTo('App\Models\MediaText', 'mediaText_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interests()
    {
        return $this->hasMany('App\Models\Interest', 'media_id');
    }
}
