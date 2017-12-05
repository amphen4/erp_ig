<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Marca;

class AdminMarcasController extends Controller
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
        return view('adminuser.marcas.tablaMarcas',['filas' => Marca::all(),'titulo_tabla' => 'Marcas de productos', 'descripcion_tabla' => '']);
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
                                  ]);
        $wow = new Marca;
        $wow->nombre = $request->nombre;
        $wow->save();

        return redirect(url('adminuser/marcas'))->with('mensaje','Marca Creada con exito!');
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
        $marca = Marca::findOrFail($id);
        return view('adminuser.marcas.editarMarca',['marca' => $marca]);
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
        $marca = Marca::findOrFail($id);
        $this->validate($request, ['nombre' => 'required|string|max:100'
                                  ]);
        $marca->nombre = $request->nombre;
        $marca->save();
        return redirect(url('/adminuser/marcas'))->with('mensaje','Marca: '.$marca->nombre.' se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        Marca::destroy($id);
        return redirect(url('/adminuser/marcas'))->with('mensaje','Marca: '.$marca->nombre.' se eliminó correctamente');
    }
}
