<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditonota extends Model
{
    protected $fillable = ['fecha','texto','filename'];

    // Relaciones Uno 0 a Uno
    public function factura()
    {
        return $this->belongsTo('App\Factura');
    }
    public function ot()
    {
        return $this->belongsTo('App\Ot');
    }
    // Relaciones Muchos a uno
    public function ventasuser()
    {
        return $this->belongsTo('App\Ventasuser');
    }
}
