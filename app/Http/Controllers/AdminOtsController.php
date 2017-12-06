<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ot;
use App\Reporte;
use Carbon\Carbon;
use App\OtFPDF;
use App\Otestado;

class AdminOtsController extends Controller
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
        /*dd(Ot::whereHas('otestado', function ($query) {
                                    $query->where('nombre', '=', 'EN COTIZACION');
                                })->get()->toArray());*/
        return view('adminuser.ots.tablaOts',['filas' => Ot::orderBy('fecha', 'desc')->limit(100)->get(),'titulo_tabla' => 'Ordenes de Trabajo', 'descripcion_tabla' => 'Descripcion de la tabla...']);
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
            case 'EN COTIZACION':
                return view('adminuser.ots.enCotizacion',['ot' => $ot]);
            case 'PENDIENTE':
                $cotizacion = $ot->cotizacion;
                return view('adminuser.cotizaciones.editarCotizacion',['cotizacion' => $cotizacion]);
            case 'EN PROCESO':
                return view('adminuser.ots.enProceso',['ot' => $ot]);
            case 'ACTIVA':
                return view('adminuser.ots.activa',['ot' => $ot]);
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
        $this->validate($request, ['fecha' => 'required|date',
                                   'nro' => 'required|numeric',
                                   'comentario' => 'required|string',
                                   'estado' => 'required|string'
                                  ]);
        switch($request->estado){
            case 'EN PROCESO':
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','EN PROCESO')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->nro = $request->nro;
                $ot->fecha = $request->fecha;
                $ot->adminuser()->associate(Auth::user());
                $ot->save();
                if($request->comision) $ot->cotizacion->comision_vendedor = $request->comision;
                $reporte = new Reporte();
                $reporte->comentario = $request->comentario;
                $reporte->ot()->associate($ot);
                $reporte->otestado()->associate($otestado);
                $reporte->fecha = Carbon::now()->format('Y-m-d');
                $oao = new OtFPDF();
                $reporte->filename = $oao->generarReporte($ot);
                $reporte->save();

                return redirect(url('adminuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            case 'PENDIENTE':
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','PENDIENTE')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->nro = $request->nro;
                $ot->fecha = $request->fecha;
                $ot->adminuser()->associate(Auth::user());
                $ot->save();
                $reporte = new Reporte();
                $reporte->comentario = $request->comentario;
                $reporte->ot()->associate($ot);
                $reporte->otestado()->associate($otestado);
                $reporte->fecha = Carbon::now()->format('Y-m-d');
                $oao = new OtFPDF();
                $reporte->filename = $oao->generarReporte($ot);
                $reporte->save();

                return redirect(url('adminuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            case 'ACTIVA':
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','ACTIVA')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->fecha_entrega = $request->fecha_entrega;
                $ot->fecha = Carbon::now()->format('Y-m-d');
                //$ot->cotizacion->produccionuser()->associate(Auth::user());
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

                return redirect(url('adminuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            case 'POR FACTURAR':
                $this->validate($request, ['comentario' => 'required',
                                            'medio_pago' => 'required',
                                  ]);
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','POR FACTURAR')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                $ot->medio_pago = $request->medio_pago;
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

                return redirect(url('adminuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
                break;
            case 'PERDIDA':
                $this->validate($request, ['comentario' => 'required',
                                      ]);
                $ot = Ot::findOrFail($id);
                $otestado = Otestado::where('nombre','PERDIDA')->first();
                $ot->otestado()->associate($otestado);
                $ot->comentario = $request->comentario;
                //$ot->medio_pago = $request->medio_pago;
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

                return redirect(url('adminuser/ots'))->with('mensaje','Orden de Trabajo modificada exitosamente!');
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
        Ot::destroy($id);
        dd('ok');
    }
}
