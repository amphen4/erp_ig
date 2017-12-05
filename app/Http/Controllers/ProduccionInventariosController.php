<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Inventario;
use App\Sucursal;

class ProduccionInventariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['produccionuser','auth:produccionuser']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produccionuser.inventarios.tablaInventarios',['filas' => Inventario::all(),'titulo_tabla' => 'Inventarios de las sucursales', 'descripcion_tabla' => '', 'sucursales' => Sucursal::all()]);
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
        $this->validate($request, ['nombre' => 'required|string|max:100',
                                   'sucursal' => 'required|numeric|exists:sucursals,id',
                                  ]);
        $wow = new Inventario;
        $wow->nombre = $request->nombre;
        $wow->sucursal_id = $request->sucursal;
        $wow->save();

        return redirect(url('produccionuser/inventarios'))->with('mensaje','Inventario Creado con exito!');
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
        $inventario = Inventario::findOrFail($id);
        return view('produccionuser.inventarios.editarInventario',['inventario' => $inventario, 'sucursales' => Sucursal::all()]);
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
        $inventario = Inventario::findOrFail($id);
        $this->validate($request, ['nombre' => 'required|string|max:100',
                                    'sucursal' => 'required|numeric|exists:sucursals,id'
                                  ]);
        $inventario->nombre = $request->nombre;
        $inventario->sucursal_id = $request->sucursal;
        $inventario->save();
        return redirect(url('/produccionuser/inventarios'))->with('mensaje','Inventario: '.$inventario->nombre.' se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        Inventario::destroy($id);
        return redirect(url('/produccionuser/inventarios'))->with('mensaje','Inventario: '.$inventario->nombre.' se eliminó correctamente');
    }
}
