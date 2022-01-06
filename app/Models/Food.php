<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_menu
 * @property string $name
 * @property string $description
 * @property int $price
 * @property string $image
 * @property Menu $menu
 */
class Food extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comidas';

    /**
     * @var array
     */
    protected $fillable = ['id_menu', 'name', 'description', 'price', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('App\Menu', 'id_menu');
    }
}
