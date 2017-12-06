<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Marca;
use App\Categoria;
use App\Inventario;

class RootCsvProductosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['root','auth:root']);
    }
    public function index()
    {
    	return view('root.importarCsvProductos');

    }
    public function store(Request $request)
    {

    	//dd($request);
    	$file = $request->file('file');
    	$csvData = file_get_contents($file);
    	//dd($csvData);
    	$rows = explode("\n", $csvData);
    	$header = array_shift($rows);
    	//dd($rows);
    	//$rows[655] = null;
    	foreach($rows as $row)
    	{
    		$arreglo = explode(";",$row);
    		$nuevo = new Producto;
    		$nuevo->codigo = $arreglo[0];
    		//dd($arreglo[5]);
    		$nuevo->nombre = $arreglo[1];
    		$marca = Marca::find(Marca::where('nombre',$arreglo[2])->first()->id);
    		//dd($marca);
    		$nuevo->marca()->associate($marca);
    		$categoria = Categoria::find(Categoria::where('nombre',$arreglo[3])->first()->id);
    		$nuevo->categoria()->associate($categoria);
    		$nuevo->precio_neto = $arreglo[5];
    		$nuevo->precio_venta = $arreglo[5];
    		$nuevo->precio_iva = $arreglo[5];
    		$nuevo->precio_iva*= 0.19;
    		$nuevo->stock = 99;
    		$inventario = Inventario::find(Inventario::where('id',1)->first()->id);
    		$nuevo->inventario()->associate($inventario);
    		$nuevo->save();
    	}
    	dd('ok');
    }
}
