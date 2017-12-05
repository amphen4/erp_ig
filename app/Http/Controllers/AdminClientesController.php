<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cliente;

class AdminClientesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['adminuser','auth:adminuser']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminuser.clientes.tablaClientes',['filas' => Cliente::all(),'titulo_tabla' => 'Clientes', 'descripcion_tabla' => '*Se puede filtrar por cualquier campo en el cuadro de busqueda']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
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
        $cliente = new Cliente;
        $cliente->nombre = $request->nombre;
        $cliente->email = $request->email;
        $cliente->comuna = $request->comuna;
        $cliente->region = $request->region;
        $cliente->nro = $request->nro;
        $cliente->direccion = $request->direccion;
        if(isset($request->razon_social))
        {
          $cliente->razon_social = $request->razon_social;
        }
        if(isset($request->empresa)){
          $cliente->empresa = $request->empresa;
        }
        $cliente->fono1 = $request->fono1;
        $cliente->giro = $request->giro;
        if(isset($request->fono2)){
          $cliente->fono2 = $request->fono2;
        }
        $cliente->rut = $request->rut;

        $cliente->save();

        return redirect(url('/adminuser/clientes'))->with('mensaje','Cliente ingresado al sistema exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('adminuser.clientes.editarCliente',['cliente' => Cliente::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $this->validate($request, ['nombre' => 'required|string|max:100',
                                   'email' => 'required|string|email|max:100',
                                   'comuna' => 'required|string|max:100', 
                                   'region' => 'required|string|max:100',
                                   'nro' => 'required|numeric',
                                   'direccion' => 'required|string|max:100',
                                   'razon_social' => 'required|string|max:100',
                                   'rut' => 'required|string|max:20',
                                   'giro' => 'required|string|max:100',
                                   'empresa' => 'nullable|string|max:100',
                                   'fono1' => 'required|string|max:100',
                                   'fono2' => 'nullable|string|max:100'
                                  ]);
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->nombre;
        $cliente->email = $request->email;
        $cliente->comuna = $request->comuna;
        $cliente->region = $request->region;
        $cliente->nro = $request->nro;
        $cliente->direccion = $request->direccion;
        $cliente->razon_social = $request->razon_social;
        if(isset($request->empresa)){
          $cliente->empresa = $request->empresa;
        }
        $cliente->fono1 = $request->fono1;
        $cliente->giro = $request->giro;
        if(isset($request->fono2)){
          $cliente->fono2 = $request->fono2;
        }
        $cliente->rut = $request->rut;

        $cliente->save();

        return redirect(url('adminuser/clientes'))->with('mensaje','Cliente '.$cliente->razon_social.' actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        dd('ok');
    }
}
