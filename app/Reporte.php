<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $fillable = ['fecha','comentario','filename','id'];

    // Relaciones Muchos a uno
    public function ot()
    {
        return $this->belongsTo('App\Ot');
    }
    // Relaciones Muchos a uno
    public function otestado()
    {
        return $this->belongsTo('App\Otestado');
    }
}
