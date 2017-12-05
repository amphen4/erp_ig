<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Factura;

class FacturacionFacturasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['facturacionuser','auth:facturacionuser']);
    }
    public function index()
    {
        return view('facturacionuser.facturas.tablaFacturas',['filas' => Factura::orderBy('fecha', 'desc')->limit(100)->get(),'titulo_tabla' => 'Facturas', 'descripcion_tabla' => 'Descripcion de la tabla...']);
    }
}
