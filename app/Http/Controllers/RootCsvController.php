<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class RootCsvController extends Controller
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
    	return view('root.importarCsv');

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
    	$rows[655] = null;
    	foreach($rows as $row)
    	{
    		$arreglo = explode(";",$row);
    		$nuevo = new Cliente;
    		$nuevo->empresa = $arreglo[1];
    		$nuevo->razon_social = $arreglo[2];
    		$nuevo->nombre = $arreglo[5];
    		$nuevo->giro = $arreglo[6];
    		$nuevo->direccion = $arreglo[8];
    		$nuevo->email = '';
    		$nuevo->rut = '';
    		$nuevo->fono1 = $arreglo[18];
    		$nuevo->nro = 0;
    		$nuevo->save();
    	}
    	dd('ok');
    }
}
