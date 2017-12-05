<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OtFPDF;
use App\Ot;
use App\Reporte;
use Carbon\Carbon;
use App\Otestado;
use App\Factura;

class FacturacionOtsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['facturacionuser','auth:facturacionuser']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facturacionuser.ots.tablaOts',['filas' => Ot::orderBy('fecha', 'desc')->limit(100)->get(),'titulo_tabla' => 'Ordenes de Trabajo', 'descripcion_tabla' => 'Descripcion de la tabla...']);
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
            case 'POR FACTURAR':
                return view('facturacionuser.ots.porFacturar',['ot' => $ot]);
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
        $this->validate($request, ['cliente' => 'required|string',
                                   'comentario' => 'required|string',
                                   'rut' => 'required|string',
                                   'total' => 'required|numeric',
                                   'neto' => 'required|numeric',
                                   'iva' => 'required|numeric',
                                   'estado' => 'required|string'
                                  ]);
        switch($request->estado){
            case 'FACTURADO':
                $ot = Ot::findOrFail($id);
                $factura = new Factura();
                $factura->fecha = Carbon::now()->format('Y-m-d');
                $factura->rut = $request->rut;
                $factura->cliente = $request->cliente;
                $factura->total = $request->total;
                $factura->neto = $request->neto;
                $factura->iva = $request->iva;
                $factura->facturacionuser()->associate(Auth::user());
                $factura->ot()->associate($ot);
                $factura->save();
                
                $otestado = Otestado::where('nombre','FACTURADO')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                
                $ot->fecha = Carbon::now()->format('Y-m-d');
                
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

                return redirect(url('facturacionuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
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
