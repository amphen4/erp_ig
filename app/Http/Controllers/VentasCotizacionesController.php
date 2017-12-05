<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producto;
use App\Cotizacion;
use Illuminate\Http\Response;
use App\Ventasuser;
use App\Cliente;
use Carbon\Carbon;
use App\Ot;
use App\Otestado;
use App\Reporte;
use App\CotizacionFPDF;
use App\OtFPDF;

class VentasCotizacionesController extends Controller
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
        return view('ventasuser.cotizaciones.verCotizaciones',['titulo_tabla' => 'Cotizaciones en el Sistema',
                                                                'descripcion_tabla' => 'Cotizaciones realizadas por Vendedor: '.Auth::user()->name,
                                                                'filas' => Auth::user()->cotizacion
                                                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventasuser.cotizaciones.nuevaCotizacion2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, ['cliente' => 'required|numeric|exists:clientes,id',
                                   'productos' => 'required|string',
                                   'descripcion' => 'required|string', 
                                   'despacho' => 'nullable|string|in:on,off',
                                   'montaje' => 'nullable|string|in:on,off',
                                   'diseno' => 'nullable|string|in:on,off',
                                   'nro' => 'required|numeric',
                                   'descuento_porciento' => 'nullable|numeric|min:0|max:100',
                                   'fecha' => 'required|date',
                                  ]);

        $arreglo = json_decode($request->productos);

        $wow = new Cotizacion;

        $wow->descripcion = $request->descripcion;
        if(isset($request->despacho))
        {
            if($request->despacho == 'on') $wow->despacho = true;
            else $wow->despacho = false;
        }
        if(isset($request->montaje))
        {
            if($request->montaje == 'on') $wow->montaje = true;
            else $wow->montaje = false;
        }
        if(isset($request->diseno))
        {
            if($request->diseno == 'on') $wow->diseno = true;
            else $wow->diseno = false;
        }
        
        $vendedor = Ventasuser::find(Auth::user()->id);
        $wow->ventasuser()->associate($vendedor);

        $cliente = Cliente::find($request->cliente);
        $wow->cliente()->associate($cliente);

        
        $total = 0;
        $neto = 0;
        $iva = 0;
        foreach($arreglo as $objeto)
        {
            $producto = Producto::find($objeto->id);
            $cantidad = $objeto->cantidad;

            $neto+= ($producto->precio_venta - ($producto->precio_venta*0.19))* $cantidad;
            $iva+= $producto->precio_venta*0.19 * $cantidad;
            if($objeto->descuento){
                $total+= ($producto->precio_venta * $cantidad)*(1-($objeto->descuento/100));
            }
            else{
                $total+= $producto->precio_venta * $cantidad;
            }
            
        }
        

        $wow->valor_neto = $neto;
        $wow->valor_iva = $iva;
        $wow->valor_total = $total;
        if($request->descuento_porciento && $request->descuento_porciento>0){
            $wow->descuento = $request->descuento_porciento;
            $wow->valor_total *= 1-($request->descuento_porciento/100);
        }
        $wow->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $wow->save();
        foreach($arreglo as $objeto)
        {
            $wow->producto()->save(Producto::find($objeto->id),['cantidad' => $objeto->cantidad, 'medidas' => $objeto->medidas, 'descuento' => $objeto->descuento]);
        }

        $ot = new Ot;
        //$ot->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $ot->fecha = $request->fecha;
        $ot->nro = $request->nro;
        $ot->otestado()->associate(Otestado::where('nombre','EN COTIZACION')->first());
        $ot->cotizacion()->associate($wow);
        $ot->save();

        $reporte = new Reporte;
        $reporte->ot()->associate($ot);
        $reporte->otestado()->associate(Otestado::where('nombre','EN COTIZACION')->first());
        $reporte->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $reporte->comentario = 'creada por '.Auth::user()->name;
        $aoa = new OtFPDF();
        $oao = new CotizacionFPDF();
        $oao->generarReporte($cliente->nombre,
                             $cliente->razon_social,
                             $cliente->rut,
                             $cliente->empresa,
                             $cliente->giro,
                             $cliente->direccion.', '.$cliente->comuna.', '.$cliente->region,
                             $cliente->fono1,
                             Carbon::now()->format('d-M-Y'),
                             $wow);
        $reporte->filename = $aoa->generarReporte($ot);
        $reporte->save();
        
        
        
        return redirect(url('ventasuser/cotizaciones'))->with('mensaje','Cotizacion creada con exito!');
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
        $cotizacion = Cotizacion::findOrFail($id);


        return view('ventasuser.cotizaciones.editarCotizacion',['cotizacion' => $cotizacion]);
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
        $this->validate($request, ['cliente' => 'required|numeric|exists:clientes,id',
                                   'productos' => 'required|string',
                                   'descripcion' => 'required|string', 
                                   'despacho' => 'nullable|string|in:on,off',
                                   'montaje' => 'nullable|string|in:on,off',
                                   'diseno' => 'nullable|string|in:on,off',
                                   'nro' => 'required|numeric',
                                   'descuento_porciento' => 'nullable|numeric|min:0|max:100',
                                   'fecha' => 'required|date',
                                  ]);

        $wow = Cotizacion::findOrFail($id);
        $arreglo = json_decode($request->productos);

        $wow->descripcion = $request->descripcion;
        if(isset($request->despacho))
        {
            if($request->despacho == 'on') $wow->despacho = true;
            else $wow->despacho = false;
        }
        if(isset($request->montaje))
        {
            if($request->montaje == 'on') $wow->montaje = true;
            else $wow->montaje = false;
        }
        if(isset($request->diseno))
        {
            if($request->diseno == 'on') $wow->diseno = true;
            else $wow->diseno = false;
        }
        $vendedor = $wow->ventasuser;
        $cliente = $wow->cliente;
        $total = 0;
        $neto = 0;
        $iva = 0;
        foreach($arreglo as $objeto)
        {
            $producto = Producto::find($objeto->id);
            $cantidad = $objeto->cantidad;

            $neto+= ($producto->precio_venta - ($producto->precio_venta*0.19))* $cantidad;
            $iva+= $producto->precio_venta*0.19 * $cantidad;
            if($objeto->descuento){
                $total+= ($producto->precio_venta * $cantidad)*(1-($objeto->descuento/100));
            }
            else{
                $total+= $producto->precio_venta * $cantidad;
            }
            
        }
        

        $wow->valor_neto = $neto;
        $wow->valor_iva = $iva;
        $wow->valor_total = $total;
        if($request->descuento_porciento && $request->descuento_porciento>0){
            $wow->descuento = $request->descuento_porciento;
            $wow->valor_total *= 1-($request->descuento_porciento/100);
        }
        $wow->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $wow->save();
        $wow->producto()->detach();
        foreach($arreglo as $objeto)
        {
            $wow->producto()->save(Producto::find($objeto->id),['cantidad' => $objeto->cantidad, 'medidas' => $objeto->medidas, 'descuento' => $objeto->descuento]);
        }

        $ot = $wow->ot;
        //$ot->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $ot->fecha = $request->fecha;
        $ot->nro = $request->nro;
        $ot->otestado()->associate(Otestado::where('nombre','EN COTIZACION')->first());
        $ot->cotizacion()->associate($wow);
        $ot->save();

        $reporte = new Reporte;
        $reporte->ot()->associate($ot);
        $reporte->otestado()->associate(Otestado::where('nombre','EN COTIZACION')->first());
        $reporte->fecha = Carbon::now()->format('Y-m-d H:i:s');
        $reporte->comentario = 'actualizada por '.Auth::user()->name;
        
        $oao = new CotizacionFPDF();
        $aoa = new OtFPDF();
         
        $oao->generarReporte($cliente->nombre,
                             $cliente->razon_social,
                             $cliente->rut,
                             $cliente->empresa,
                             $cliente->giro,
                             $cliente->direccion.', '.$cliente->comuna.', '.$cliente->region,
                             $cliente->fono1,
                             Carbon::now()->format('d-M-Y'),
                             $wow);
        $reporte->filename = $aoa->generarReporte($ot);
        $reporte->save();
        

        return redirect(url('ventasuser/cotizaciones'))->with('mensaje','Cotizacion actualizada con exito!');
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
