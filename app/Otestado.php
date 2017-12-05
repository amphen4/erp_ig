<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Otestado extends Model
{
    protected $fillable = ['nombre'];

    // Relacion uno a muchos
    public function ot()
    {
        return $this->hasMany('App\Ot');
    }
    // Relacion Uno a Muchos
    public function reporte()
    {
        return $this->hasMany('App\Reporte');
    }
}
