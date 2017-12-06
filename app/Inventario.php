<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = ['nombre','id'];

    // Relacion uno a muchos
    public function producto()
    {
        return $this->hasMany('App\Producto');
    }
    // Relacion muchos a uno
    public function sucursal()
    {
    	return $this->belongsTo('App\Sucursal');
    }
}
