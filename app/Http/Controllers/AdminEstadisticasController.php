<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ventasuser;
use Carbon\Carbon;
class AdminEstadisticasController extends Controller
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
    public function ventasPorVendedor()
    {
    	$vendedores =  Ventasuser::all();
    	setlocale(LC_ALL, 'Spanish_Chile');
    	//$data['totales'] = array();
    	foreach($vendedores as $vendedor)
    	{
    		$data['nombres'][] = $vendedor->name;
    		$totales['meses'] = array();
    		$totales['sumatoria'] = array();
    		$totales['nombre'] = array();

			$fecha = Carbon::now();
			//$totales['meses'][] =  $fecha->formatLocalized('%B');
			array_unshift($totales['meses'], $fecha->formatLocalized('%B'));
			$hoy = $fecha->toDateString();
			$mes = $fecha->startOfMonth()->toDateString();
			// ------ Obteniendo las ot durante el mes actual
			$cotizaciones = $vendedor->cotizacion()->whereBetween('fecha',[$mes,$hoy])->get();
			$sumaMes = 0;
			foreach($cotizaciones as $cotizacion)
			{
				if($cotizacion->ot){ // por si la ot de una cotizacion fue eliminada
					$estadoOt = $cotizacion->ot->otestado->nombre;
					if($estadoOt == 'POR FACTURAR' || $estadoOt == 'FACTURADO' ){
						$sumaMes+= $cotizacion->valor_total;
					}
				}
					
			}
			//$totales['sumatoria'][] = $sumaMes;
			array_unshift($totales['sumatoria'], $sumaMes);
			$totales['nombre'][] = $vendedor->name;
			// ----- para los 11 meses anteriores -----
			for($i=0; $i < 11; $i++)
			{
				$fecha->subDay();
				//$totales['meses'][] = $fecha->formatLocalized('%B');
				array_unshift($totales['meses'], $fecha->formatLocalized('%B'));
				$finDeMes = $fecha->toDateString();
				$fecha->startOfMonth();
				$inicioDeMes = $fecha->toDateString();
				$cotizaciones = $vendedor->cotizacion()->whereBetween('fecha',[$inicioDeMes,$finDeMes])->get();
				$sumaMes = 0;
				foreach($cotizaciones as $cotizacion)
				{
					if($cotizacion->ot){ // por si la ot de una cotizacion fue eliminada
						$estadoOt = $cotizacion->ot->otestado->nombre;
						if($estadoOt == 'POR FACTURAR' || $estadoOt == 'FACTURADO' ){
							$sumaMes+= $cotizacion->valor_total;
						}
					}
						
				}
				//$totales['sumatoria'][] = $sumaMes;
				array_unshift($totales['sumatoria'], $sumaMes);
				$totales['nombre'][] = $vendedor->name;
			}
			//array_unshift($data['totales'],$totales);
			$data['totales'][] = $totales;
    		
    	}
    	//dd($data);
    	if($data) return view('adminuser.estadisticas.ventasPorVendedor',['data' => $data]);
    	else      return view('adminuser.estadisticas.ventasPorVendedor',[]);
    }
}
