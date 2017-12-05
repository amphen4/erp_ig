<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre','email','rut','comuna','direccion','region','razon_social','nro','empresa','fono1','fono2','giro'];

    // Relacion uno a muchos
    public function cotizacion()
    {
        return $this->hasMany('App\Cotizacion');
    }
    
    // Relacion Muchos a Muchos
    public function ventasuser()
	{
		return $this->belongsToMany('App\Ventasuser');
	}


    

}
