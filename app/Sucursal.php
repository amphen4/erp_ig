<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $fillable = ['nombre','direccion'];

    // Relacion uno a muchos
    public function inventario()
    {
        return $this->hasMany('App\Inventario');
    }
    
}
