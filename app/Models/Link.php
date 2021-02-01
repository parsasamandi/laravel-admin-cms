<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $desc_id
 * @property string $text
 * @property string $link
 * @property Description $description
 */
class Link extends Model
{
    public $tmp = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'link';

    /**
     * @var array
     */
    protected $fillable = ['desc_id', 'text', 'link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function description()
    {
        return $this->belongsTo('App\Models\Description', 'desc_id');
    }
}
