<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ot;
use App\CotizacionFPDF;
use App\OtFPDF;
use Carbon\Carbon;
use App\Cotizacion;
use App\Adminuser;

class ProduccionAjaxController extends Controller
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
    public function filtrarOts(Request $request){
    	
    	$this->validate($request, ['estado' => 'required|string|max:30',
                                   'inicio' => 'required|string',
                                   'fin' => 'required|string'
                                  ]);
    	if($request->inicio == 'null' && $request->fin == 'null'){
    		if($request->estado == 'Ninguno'){
    			$arreglo['ots'] = Ot::with('otestado')->orderBy('fecha','desc')->limit(100)->get();
    			foreach($arreglo['ots'] as  $p){
    				$arreglo['otestado'][] = Ot::find($p['id'])->otestado->nombre;
    				$arreglo['idcotizacion'][] = Ot::find($p['id'])->cotizacion->id;
                    if(Adminuser::find($p['adminuser_id'])) $arreglo['adminuser'][] = Adminuser::find($p['adminuser_id'])->name;
                    else $arreglo['adminuser'][] = null;
    			}
    			return response()->json($arreglo);
    		}
    		else{
    			$arreglo['ots'] = Ot::whereHas('otestado', function ($query) use ($request) {
					                $query->where('nombre', '=', $request->estado);
					            })->orderBy('fecha','desc')->limit(100)->get()->toArray();
    			foreach($arreglo['ots'] as  $p){
    				$arreglo['otestado'][] = Ot::find($p['id'])->otestado->nombre;
    				$arreglo['idcotizacion'][] = Ot::find($p['id'])->cotizacion->id;
                    if(Adminuser::find($p['adminuser_id'])) $arreglo['adminuser'][] = Adminuser::find($p['adminuser_id'])->name;
                    else $arreglo['adminuser'][] = null;
    			}
    			return response()->json($arreglo);
    		}
    	}else{
    		if($request->estado == 'Ninguno'){
    			$arreglo['ots'] = Ot::whereBetween('fecha', [$request->inicio, $request->fin])->orderBy('fecha','desc')->limit(100)->get()->toArray();
    			foreach($arreglo['ots'] as  $p){
    				$arreglo['otestado'][] = Ot::find($p['id'])->otestado->nombre;
    				$arreglo['idcotizacion'][] = Ot::find($p['id'])->cotizacion->id;
                    if(Adminuser::find($p['adminuser_id'])) $arreglo['adminuser'][] = Adminuser::find($p['adminuser_id'])->name;
                    else $arreglo['adminuser'][] = null;
    			}
    			return response()->json($arreglo);
    		}
    		else{

    			$arreglo['ots'] = Ot::whereBetween('fecha', [$request->inicio, $request->fin])->whereHas('otestado', function ($query) use ($request) {
    							$query->where('nombre', '=', $request->estado);
    						})->orderBy('fecha','desc')->limit(100)->get()->toArray();
    			foreach($arreglo['ots'] as  $p){
    				$arreglo['otestado'][] = Ot::find($p['id'])->otestado->nombre;
    				$arreglo['idcotizacion'][] = Ot::find($p['id'])->cotizacion->id;
                    if(Adminuser::find($p['adminuser_id'])) $arreglo['adminuser'][] = Adminuser::find($p['adminuser_id'])->name;
                    else $arreglo['adminuser'][] = null;
    			}
    			return response()->json($arreglo);
    		}
    		

    	}
    }
    public function cotizacionPdf($id){
    	$cotizacion = Cotizacion::findOrFail($id);
    	$wow = new CotizacionFPDF();
    	//Datos del Contacto
		$nombre_contacto=$cotizacion->cliente->nombre;
		$razon_social=$cotizacion->cliente->razon_social;
		$rut_contacto=$cotizacion->cliente->rut;	
		$rut_empresa=$cotizacion->cliente->empresa;
		$giro=$cotizacion->cliente->giro;
		$direccion=$cotizacion->cliente->direccion.', '.$cotizacion->cliente->comuna.', '.$cotizacion->cliente->region;
		$fono=$cotizacion->cliente->fono1;
		$fecha=Carbon::now()->format('d-M-Y');
		
		$wow->imprimirReporte($nombre_contacto,$razon_social,$rut_contacto,$rut_empresa,$giro,$direccion,$fono,$fecha,$cotizacion);
		
    }
    public function otPdf($id){
        $ot = Ot::findOrFail($id);
        $wow = new OtFPDF();
        $wow->imprimirReporte($ot);
    }
}
