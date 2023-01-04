<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $description
 * @property string $status
 */
class Product extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'description', 'statua'];
}
