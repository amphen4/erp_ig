<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adminevento extends Model
{
    protected $table = 'admineventos';

    protected $fillable = ['start','end','title'];
    
}
