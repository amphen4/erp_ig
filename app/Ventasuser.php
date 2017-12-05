<?php

namespace App;

use App\Notifications\VentasuserResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ventasuser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new VentasuserResetPassword($token));
    }
    // Relaciones uno a muchos
    public function cotizacion()
    {
        return $this->hasMany('App\Cotizacion');
    }
    public function creditonota()
    {
        return $this->hasMany('App\Creditonota');
    }
    // Relacion Muchos a Muchos
    public function cliente()
    {
        return $this->belongsToMany('App\Cliente');
    }
}
