<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $description
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Menus extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'menus';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'description', 'image', 'created_at', 'updated_at'];

}
