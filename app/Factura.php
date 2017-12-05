<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['filename','rut','cliente','fecha','total','iva','neto'];

    // Relacion Uno 0 a Uno
    public function ot()
    {
        return $this->belongsTo('App\Ot');
    }
    // Relacion Uno a Uno 0
	public function creditonota()
    {
    	return $this->hasOne('App\Creditonota');
    }
    // Relaciones Muchos a uno
    public function facturacionuser()
    {
        return $this->belongsTo('App\Facturacionuser');
    }
}
