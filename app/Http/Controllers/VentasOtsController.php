<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OtFPDF;
use App\Ot;
use App\Reporte;
use Carbon\Carbon;
use App\Otestado;

class VentasOtsController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arregloIds = array();    
        foreach(Auth::user()->cotizacion as $cotizacion) $arregloIds[] = $cotizacion->id;
        return view('ventasuser.ots.tablaOts',['filas' => Ot::whereIn('cotizacion_id',$arregloIds)->orderBy('fecha', 'desc')->limit(100)->get(),'titulo_tabla' => 'Ordenes de Trabajo', 'descripcion_tabla' => 'Ordenes de Trabajo realizadas por: '.Auth::user()->name]);
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
        //
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
        $ot = Ot::findOrFail($id);

        switch ($ot->otestado->nombre){
            case 'ACTIVA':
                return view('ventasuser.ots.activa',['ot' => $ot]);
            default:
                return abort(404);
        }
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
        //dd($request);
        $this->validate($request, ['medio_pago' => 'required|string',
                                   'comentario' => 'required|string',
                                   'estado' => 'required|string',
                                   'nro' => 'required'
                                  ]);
        switch($request->estado){
            case 'POR FACTURAR':
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','POR FACTURAR')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->medio_pago = $request->medio_pago;
                $ot->fecha = Carbon::now()->format('Y-m-d');
                $ot->nro = $request->nro;
                $ot->cotizacion->save();
                $ot->save();
                $reporte = new Reporte();
                $reporte->comentario = $request->comentario;
                $reporte->ot()->associate($ot);
                $reporte->otestado()->associate($otestado);
                $reporte->fecha = Carbon::now()->format('Y-m-d');
                $oao = new OtFPDF();
                $reporte->filename = $oao->generarReporte($ot);
                $reporte->save();

                return redirect(url('ventasuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            case 'PERDIDA':
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','PERDIDA')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->medio_pago = $request->medio_pago;
                $ot->fecha = Carbon::now()->format('Y-m-d');
                $ot->nro = $request->nro;
                $ot->cotizacion->save();
                $ot->save();
                $reporte = new Reporte();
                $reporte->comentario = $request->comentario;
                $reporte->ot()->associate($ot);
                $reporte->otestado()->associate($otestado);
                $reporte->fecha = Carbon::now()->format('Y-m-d');
                $oao = new OtFPDF();
                $reporte->filename = $oao->generarReporte($ot);
                $reporte->save();

                return redirect(url('ventasuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            default:
                return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
