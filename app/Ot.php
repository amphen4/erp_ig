<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    protected $fillable = ['comentario','fecha','id','fecha_entrega','nro','adminuser_id'];

    // Relacion Uno 0 a Uno
    public function cotizacion()
    {
        return $this->belongsTo('App\Cotizacion');
    }
    // Relacion Uno a Uno 0
	public function factura()
    {
    	return $this->hasOne('App\Factura');
    }
    // Relacion Uno a Uno 0
	public function creditonota()
    {
    	return $this->hasOne('App\Creditonota');
    }
    // Relacion Uno a Muchos
    public function reporte()
    {
        return $this->hasMany('App\Reporte');
    }
    // Relaciones Muchos a uno
    public function otestado()
    {
        return $this->belongsTo('App\Otestado');
    }
    public function adminuser()
    {
        return $this->belongsTo('App\Adminuser');
    }
}
