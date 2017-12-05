<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Response;

class VentasClientesController extends Controller
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
    public function enviarClientes()
    {
        return Cliente::all()->toJson();
    }
    public function guardarCliente(Request $request)
    {
        $this->validate($request, ['nombre' => 'required|string|max:100',
                                   'email' => 'required|string|email|max:100',
                                   'comuna' => 'required|string|max:100', 
                                   'region' => 'required|string|max:100',
                                   'nro' => 'required|numeric',
                                   'direccion' => 'required|string|max:100',
                                   'razon_social' => 'nullable|string|max:100',
                                   'rut' => 'required|string|max:20',
                                   'giro' => 'required|string|max:100',
                                   'empresa' => 'nullable|string|max:100',
                                   'fono1' => 'required|string|max:100',
                                   'fono2' => 'nullable|string|max:100'
                                  ]);
        $new = new Cliente;
        $new->nombre = $request->nombre;
        $new->email = $request->email;
        $new->comuna = $request->comuna;
        $new->region = $request->region;
        $new->nro = $request->nro;
        $new->direccion = $request->direccion;
        if(isset($request->razon_social))
        {
          $new->razon_social = $request->razon_social;
        }
        if(isset($request->empresa)){
          $new->empresa = $request->empresa;
        }
        $new->fono1 = $request->fono1;
        $new->giro = $request->giro;
        if(isset($request->fono2)){
          $new->fono2 = $request->fono2;
        }
        $new->rut = $request->rut;

        $new->save();

        return response()->json([
            'wow' => 'Wow'
        ]);

    }
}
