<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Auth;

class VentasProductosController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['ventasuser','auth:ventasuser']);
    }
    public function enviarProductos()
    {
        return Producto::all()->toJson();
    }
}
