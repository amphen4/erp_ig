<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;

class AdminCategoriasController extends Controller
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
        return view('adminuser.categorias.tablaCategorias',['filas' => Categoria::all(),'titulo_tabla' => 'Categorias de productos', 'descripcion_tabla' => '']);
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
        $wow = new Categoria;
        $wow->nombre = $request->nombre;
        $wow->save();

        return redirect(url('adminuser/categorias'))->with('mensaje','Categoria Creada con exito!');
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
        $categoria = Categoria::findOrFail($id);
        return view('adminuser.categorias.editarCategoria',['categoria' => $categoria]);
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
        $categoria = Categoria::findOrFail($id);
        $this->validate($request, ['nombre' => 'required|string|max:100'
                                  ]);
        $categoria->nombre = $request->nombre;
        $categoria->save();
        return redirect(url('/adminuser/categorias'))->with('mensaje','Categoria: '.$categoria->nombre.' se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        Categoria::destroy($id);
        return redirect(url('/adminuser/categorias'))->with('mensaje','Categoria: '.$categoria->nombre.' se eliminó correctamente');
    }
}
