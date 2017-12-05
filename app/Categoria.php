<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    // Relacion uno a muchos
    public function producto()
    {
        return $this->hasMany('App\Producto');
    }
}
