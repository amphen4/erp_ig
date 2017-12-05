<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['id','nombre','stock','precio_venta','precio_neto','precio_iva','codigo'];


    // Relaciones Muchos a uno
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
    public function marca()
    {
        return $this->belongsTo('App\Marca');
    }
    public function inventario()
    {
    	return $this->belongsTo('App\Inventario');
    }
    // Relacion Muchos a Muchos
    public function cotizacion()
    {
        return $this->belongsToMany('App\Cotizacion');
    }
}
