<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
	protected $fillable = ['valor_total','valor_neto','valor_iva','comision_vendedor','fecha','descripcion','descuento','nro'];


	// Relacion Uno a Uno 0
	public function ot()
    {
        return $this->hasOne('App\Ot');
    }
    // Relaciones Muchos a uno
    public function ventasuser()
    {
        return $this->belongsTo('App\Ventasuser');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
    public function produccionuser()
    {
    	return $this->belongsTo('App\Produccionuser');
    }
    // Relacion Muchos a Muchos
    public function producto()
    {
        return $this->belongsToMany('App\Producto')->withPivot('cantidad','medidas','descuento');
    }

    

}
