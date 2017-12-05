<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Producto;
use App\Categoria;
use App\Inventario;
use App\Marca;

class ProduccionProductosController extends Controller
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
        
        //dd($lista);
        return view('produccionuser.productos.tablaProductos',
            ['titulo_tabla' => 'Lista de Productos',
             'descripcion_tabla' => '',
             'filas' => Producto::all(),
             'categorias' => Categoria::all(),
             'marcas' => Marca::all(),
             'inventarios' => Inventario::all(),
             'total_productos' => Producto::count(),
             'producto_mayor_stock' => Producto::orderBy('stock','desc')->take(1)->first(),
             'productos_sin_stock' => Producto::where('stock',0)->count(),
            ]);
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
                                   'stock' => 'required|numeric|min:0',
                                   'precio_neto' => 'required|numeric|min:0',
                                   'precio_venta' => 'required|numeric|min:0',
                                   'codigo_interno' => 'required|numeric',
                                   'categoria' => 'required|exists:categorias,id',
                                   'marca' => 'required|exists:marcas,id',
                                   'inventario' => 'required|exists:inventarios,id'
                                  ]);
        $wow = new Producto;
        $wow->nombre = $request->nombre;
        $wow->stock = $request->stock;
        $wow->precio_neto = $request->precio_neto;
        $wow->precio_iva = $request->precio_neto*0.19;
        $wow->precio_venta = $request->precio_venta;
        $wow->codigo = $request->codigo_interno;
        $wow->categoria_id = $request->categoria;
        $wow->marca_id = $request->marca;
        $wow->inventario_id = $request->inventario;
        $wow->save();

        return redirect(url('/produccionuser/productos'))->with('mensaje','Producto Agregado Correctamente!');
        dd($request);
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
        $producto = Producto::findOrFail($id);
        return view('produccionuser.productos.editarProducto',['producto' => $producto, 'marcas' => Marca::all(), 'categorias' => Categoria::all(), 'inventarios' => Inventario::all()]);
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
        $producto = Producto::findOrFail($id);
        $this->validate($request, ['nombre' => 'required|string|max:100',
                                   'stock' => 'required|numeric|min:0',
                                   'precio_neto' => 'required|numeric|min:0',
                                   'precio_venta' => 'required|numeric|min:0',
                                   'codigo_interno' => 'required|numeric',
                                   'categoria' => 'required|exists:categorias,id',
                                   'marca' => 'required|exists:marcas,id',
                                   'inventario' => 'required|exists:inventarios,id'
                                  ]);
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->precio_neto = $request->precio_neto;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_iva = $producto->precio_venta*0.19;
        $producto->codigo = $request->codigo_interno;
        $producto->categoria_id = $request->categoria;
        $producto->marca_id = $request->marca;
        $producto->inventario_id = $request->inventario;

        $producto->save();

        return redirect(url('/produccionuser/productos'))->with('mensaje','Producto: '.$producto->nombre.' se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        Producto::destroy($id);
        return redirect(url('/produccionuser/productos'))->with('mensaje','Producto: '.$producto->nombre.' se eliminó correctamente');
    }
}
