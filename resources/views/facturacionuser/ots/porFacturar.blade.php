@extends('facturacionuser.layout.gentelella')
@section('title','Editar O.T | Facturacion')
@section('css')
<!-- bootstrap-daterangepicker -->
<link href="{{asset('templates/gentelella')}}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="{{asset('templates/gentelella')}}/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@endsection
@section('contenido')
<div class="">
	<div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel">
          <div class="x_title">
            <h2><i class="fa fa-pencil-square-o"></i> Orden de Trabajo N° {{$ot->id}} <small>{{$ot->otestado->nombre}}</small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal form-label-left" id="formWow" method="POST" action="{{url('facturacionuser/ots').'/'.$ot->id}}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content4" id="factura-tab" role="tab" data-toggle="tab" aria-expanded="true">Detalles Factura</a>
                </li>
                <li role="presentation" ><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Detalles Orden de Trabajo</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Detalles Cotizacion</a>
                </li>
                @if($ot->cotizacion->cliente)
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Detalles Cliente</a>
                </li>
                @endif
              </ul>
              
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content4" aria-labelledby="home-tab">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Fecha: 
                      </label>
                      <div class="col-md-7">
                        <div class='input-group date' id='Datepicker'>
                            <input type='text'  disabled value="{{$ot->fecha}}" class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Cliente a facturar: 
                      </label>
                      <div class="col-md-7">
                        <input value="@if($ot->cotizacion->cliente){{$ot->cotizacion->cliente->nombre}}@else Cliente Eliminado @endif" type="text"  name="cliente"  class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >RUT a facturar: 
                      </label>
                      <div class="col-md-7">
                        <input value="@if($ot->cotizacion->cliente) @if($ot->cotizacion->cliente->empresa){{$ot->cotizacion->cliente->empresa}}@else{{$ot->cotizacion->cliente->rut}}@endif @else Cliente Eliminado @endif" type="text" name="rut"  class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >N° de documento: 
                      </label>
                      <div class="col-md-7">
                        <input disabled value="{{$ot->nro}}" type="text" id="last-name2" name="nro" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Medio de Pago: 
                      </label>
                      <div class="col-md-7">
                        <input disabled value="{{$ot->medio_pago}}" type="text" id="last-name2"  required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Total: 
                      </label>
                      <div class="col-md-7">
                        <input  value="{{$ot->cotizacion->valor_total}}" type="text" id="total" name="total" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >IVA: 
                      </label>
                      <div class="col-md-7">
                        <input value="{{$ot->cotizacion->valor_iva}}" type="text" id="iva" name="iva" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >NETO: 
                      </label>
                      <div class="col-md-7">
                        <input  value="{{$ot->cotizacion->valor_neto}}" type="text" id="neto" name="neto" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Comentario reporte: 
                      </label>
                      <div class="col-md-7">
                        <textarea  required name="comentario" class="resizable_textarea form-control" ></textarea>
                      </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content1" aria-labelledby="home-tab">
                 	
	                  <div class="form-group">
	                    <label class="control-label col-md-3" for="first-name">Ultima Fecha de Modificación: 
	                    </label>
	                    <div class="col-md-7">
	                      <div class='input-group date' >
                            <input type='text'  disabled value="{{$ot->fecha}}" class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
	                    </div>
	                  </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Fecha de Entrega: 
                      </label>
                      <div class="col-md-7">
                        <div class='input-group date' >
                            <input disabled type='text' value="{{$ot->fecha_entrega}}" required="required" class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                    </div>
                    
	                  <div class="form-group">
                      <label class="control-label col-md-3" >N° de documento: 
                      </label>
                      <div class="col-md-7">
                        <input disabled value="{{$ot->nro}}" type="text"  name="nro"  class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Medio de Pago: 
                      </label>
                      <div class="col-md-7">
                        <input disabled value="{{$ot->medio_pago}}" type="text" id="last-name2" name="nro" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3" >Comentario reporte actual: 
                      </label>
                      <div class="col-md-7">
                        <textarea  disabled value="" class="resizable_textarea form-control" >{{$ot->comentario}}</textarea>
                      </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Ultima Fecha de Modificación: 
                      </label>
                      <div class="col-md-7">
                        <input value="{{$ot->cotizacion->fecha}}" disabled type="text" id="fecha_cot" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <br>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2>Productos</h2>
                        <div class="table-responsive">
                          <table class="table table-striped jambo_table bulk_action">
                            <thead>
                              <tr class="headings">
                                <th>ID</th>
                                <th class="column-title">Producto</th>
                                <th class="column-title">Precio Costo</th>
                                <th class="column-title">IVA (19%)</th>
                                <th class="column-title">Precio Venta</th>
                                <th class="column-title">Cantidad</th>
                                <th class="column-title">Medidas</th>
                                <th class="column-title">Descuento(%)</th>
                                <th class="column-title">Total Producto</th>
                                <th class="column-title" ></th>
                              </tr>
                            </thead>
                            <tbody id="body">
                              @foreach($ot->cotizacion->producto as $producto)
                              <tr>
                                <td> {{$producto->id}} </td>
                                <td> {{$producto->nombre}} </td>
                                <td><i class="success fa fa-usd"></i> {{number_format($producto->precio_neto,0,",",".")}} </td>
                                <td><i class="success fa fa-usd"></i> {{number_format($producto->precio_iva,0,",",".")}} </td>
                                <td><i class="success fa fa-usd"></i> {{number_format($producto->precio_venta,0,",",".")}} </td>
                                <td> {{$producto->pivot->cantidad}} </td>
                                <td> {{$producto->pivot->medidas}} </td>
                                <td> {{$producto->pivot->descuento}} (%)</td>
                                <td><i class="success fa fa-usd"></i> @if($producto->pivot->descuento && $producto->pivot->descuento > 0){{number_format($producto->precio_venta*$producto->pivot->cantidad*(1-($producto->pivot->descuento/100)),0,",",".")}}@else {{number_format($producto->precio_venta*$producto->pivot->cantidad,0,",",".")}}@endif </td>
                                <td>  </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                              <tr>
                                <td></td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td> Descuento al Total </td>
                                <td ><p> <label> {{$ot->cotizacion->descuento}} %</label> </p></td>
                                <td ></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                <td> TOTAL Cotizacion </td>
                                <td ><p><i class="success fa fa-usd"></i> <label> {{number_format($ot->cotizacion->valor_total,0,",",".")}}</label> </p></td>
                                <td ></td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <label>
                            @if($ot->cotizacion->despacho)
                            <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Despacho 
                            @else
                            <input type="checkbox" class="flat" disabled="disabled"> Despacho
                            @endif
                          </label> 
                          <label>
                            @if($ot->cotizacion->montaje)
                            <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Montaje 
                            @else
                            <input type="checkbox" class="flat" disabled="disabled"> Montaje
                            @endif
                          </label><label>
                            @if($ot->cotizacion->diseno)
                            <input type="checkbox" class="flat" disabled="disabled" checked="checked"> Diseño 
                            @else
                            <input type="checkbox" class="flat" disabled="disabled"> Diseño
                            @endif
                          </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> Descripcion:</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea  disabled  class="resizable_textarea form-control" >{{$ot->cotizacion->descripcion}}</textarea>
                      </div>
                    </div>
                </div>
                @if($ot->cotizacion->cliente)
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                    <div class="well profile_view">
                      <div class="col-sm-12">
                        <h4 class="brief"><i>Rut Empresa: {{$ot->cotizacion->cliente->empresa}}</i></h4>
                        <div class="left col-xs-7">
                          <h2>{{$ot->cotizacion->cliente->nombre}}</h2>
                          <p><i class="fa fa-user"></i> <strong>Razon Social: </strong> {{$ot->cotizacion->cliente->razon_social}} </p>
                          <ul class="list-unstyled">
                            <li><i class="fa fa-user"></i> R.U.T: {{$ot->cotizacion->cliente->rut}}</li>
                            <li><i class="fa fa-envelope"></i> E-mail: {{$ot->cotizacion->cliente->email}}</li>
                            <li><i class="fa fa-building"></i> Direccion: {{$ot->cotizacion->cliente->direccion.', '.$ot->cotizacion->cliente->comuna.', '.$ot->cotizacion->cliente->region}}</li>
                            <li><i class="fa fa-phone"></i> Fono #1: {{$ot->cotizacion->cliente->fono1}}</li>
                            <li><i class="fa fa-phone"></i> Fono #2: {{$ot->cotizacion->cliente->fono2}}</li>
                          </ul>
                        </div>
                        <div class="right col-xs-5 text-center">
                          <img src="{{asset('templates/gentelella/production')}}/images/user.png" alt="" class="img-circle img-responsive">
                        </div>
                      </div>
                      <div class="col-xs-12 bottom text-center">
                        <div class="col-xs-12 col-sm-6 emphasis">
                          <p class="ratings">
                            
                          </p>
                        </div>
                        <div class="col-xs-12 col-sm-6 emphasis">
                          <a type="button"  href="#" class="btn btn-warning btn-xs"> <i class="fa fa-edit">
                            </i> Ir a: Editar Cliente</a>
                          <a  href="#" class="btn btn-primary btn-xs">
                            <i class="fa fa-user"> </i> Ir a: Ver Cliente
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
              </div>
              
            </div>
            </form>
            <div class="well" style="overflow: auto">
            	<div class="col-md-4 ">
            		Cambiar Estado
                <fieldset>
                  <div class="control-group ">
                    <div class="controls ">
    				            <select name="estado" class="form-control" id="selectWow" form="formWow">
                          <option>FACTURADO</option>
                          <option disabled>EN PROCESO</option>
                          <option disabled>PENDIENTE</option>
                          <option disabled>ACTIVA</option>
                          <option disabled>POR FACTURAR</option>
                          <option disabled>PERDIDA</option>
                          <option disabled>NOTA DE VENTA</option>
    				            </select>
    				        </div>
    				      </div>
		            </fieldset>  
	        	  </div>
  	        	<div class="col-md-4 pull-right">
          		    <br>
                  <fieldset>
                    <div class="control-group ">
                      <div class="controls ">
                      	<a href="{{url('facturacionuser/ots')}}" class="btn btn-default">Cancelar</a><button form="formWow" type="submit" class="btn btn-primary">Guardar Cambios</button>
                      </div>
                    </div>
                  </fieldset>
              </div>
	        </div>
          
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('plugins/cleave.js/dist')}}/cleave.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('templates/gentelella')}}/vendors/moment/min/moment.min.js"></script>
<script src="{{asset('templates/gentelella')}}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="{{asset('templates/gentelella')}}/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- jquery.inputmask -->
<script src="{{asset('templates/gentelella')}}/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script>
  var total = new Cleave('#total', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
  });
  var neto = new Cleave('#neto', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
  });
  var iva = new Cleave('#iva', {
    numeral: true,
    numeralDecimalMark: ',',
    delimiter: '.'
  });
$('#Datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        useCurrent: true
    });

$('#formWow').submit(function(event){
    $('#total').val(total.getRawValue());
    $('#neto').val(neto.getRawValue());
    $('#iva').val(iva.getRawValue());
    if(!confirm('Esta seguro de cambiar de estado: {{$ot->otestado->nombre}} a estado: '+$('#selectWow').val()+' ?')) event.preventDefault();
});

</script>

@endsection