@extends('ventasuser.layout.gentelella')
@section('title','Nueva Cotizacion | Ventas')
@section('css')
<link href="{{asset('plugins/flexdatalist')}}/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('contenido')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Nueva Cotización </h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form id="wow" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="{{ url('/ventasuser/cotizaciones') }}">
          {{ csrf_field() }}
          <input type="hidden" id="inputProductos" name="productos">
          <input type="hidden" id="inputCliente" name="cliente">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cliente:</label>
            <div class="col-md-6 col-sm-6 col-xs-12 input-group">
            	<input   type="text"  required="required" class="flexdatalistcliente form-control col-md-7 col-xs-12">
            	<span class="input-group-btn"><button type="button" id="botonNuevoCliente" class="btn btn-success"><span class="fa fa-plus"></span> Nuevo Cliente</button></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Productos:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  type="text" class='flexdatalistproductos form-control col-md-7 col-xs-12'   data-data='{{url("ventasuser/productos.json")}}' required="required" multiple='multiple' data-search-in='nombre'  data-min-length='1' >
              <br>
              <p ><label>Total Neto: $ </label> <label id="totalNeto"></label></p>
              <p ><label>Total IVA: $ </label> <label id="totalIva"></label></p>
              <p ><label>Total Venta: $ </label> <label id="totalVenta"></label></p>
            </div>
          </div>
          
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion :</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="message" required="required" class="form-control" name="descripcion" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
              </div>
          </div>

          <div class="form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
	          <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="despacho" class="flat"> Despacho 
                    </label> 
                	<label>
                      <input type="checkbox" name="diseno" class="flat"> Diseño 
                    </label>
                    <label> 
                      <input type="checkbox" name="montaje" class="flat"> Montaje 
                    </label> 
	          </div>
	      </div>
          
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
        
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Nombre:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="nombreCliente"  >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">E-mail:</label>

                            <div class="col-md-6">
                                <input  type="email" class="form-control" id="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">R.U.T:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="rut"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Comuna, Region:</label>

                            <div class="col-md-6">
                                <input type="text"  class="form-control flexdatalistcomunas">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Direccion:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="direccionCliente"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Razón Social:</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="razon_social"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Numero interno:</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control" id="nro"  >
                            </div>
                        </div>
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  type="button" id="botonGuardar" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="{{asset('plugins/flexdatalist')}}/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalistcliente').flexdatalist({
     minLength: 1,
     searchIn: 'nombre',
     data: '{{url("ventasuser/clientes.json")}}',
     allowDuplicateValues: false,
     textProperty: '{nombre}, Rut: {rut}, Razon Social: {razon_social}',
     visibleProperties: ["nombre","rut","razon_social"],
     searchByWord: true,
     valueProperty: 'id',
});
$('.flexdatalistproductos').flexdatalist({
     minLength: 1,
     searchIn: 'nombre',
     data: '{{url("ventasuser/productos.json")}}',
     allowDuplicateValues: true,
     textProperty: '{nombre},  Precio Venta: ${precio_venta}',
     visibleProperties: ["nombre","stock","precio_venta"],
     searchByWord: true,
     valueProperty: '*',
     selectionRequired: true,
});
$('.flexdatalistcomunas').flexdatalist({
     minLength: 1,
     searchIn: 'name',
     data: '{{url("/storage/comunas.json")}}',
     groupBy: 'region',
     visibleProperties: ["name"],
     textProperty: '{name}, {region}',
     searchByWord: true,
     valueProperty: '*'
});
</script>
$<script>
$(document).ready(function(){
    $("#botonNuevoCliente").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    $("#botonGuardar").on("click", function() {
    	/*alert($('.flexdatalistcomunas').flexdatalist('value').name);*/
    	var comuna = $('.flexdatalistcomunas').flexdatalist('value').name;
    	var region = $('.flexdatalistcomunas').flexdatalist('value').region;
    	var nombre = $('#nombreCliente').val();
    	var direccion = $('#direccionCliente').val();
    	var email = $('#email').val();
    	var razon_social = $('#razon_social').val();
    	var nro = $('#nro').val();
    	var rut = $('#rut').val();
    	$.ajax({
			type: "POST",
			url: "{{url('ventasuser/clientes')}}",
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: 'comuna='+comuna+'&region='+region+'&nombre='+nombre+'&direccion='+direccion+'&email='+email+'&razon_social='+razon_social+'&nro='+nro+'&rut='+rut,
			success: function(json) {
					$('.close').click();
					
					$('.flexdatalistcliente').flexdatalist({
						minLength: 1,
					    searchIn: 'nombre',
					    data: '{{url("ventasuser/clientes.json")}}',
					    allowDuplicateValues: false,
					    textProperty: '{nombre}, Rut: {rut}, Razon Social: {razon_social}',
					    visibleProperties: ["nombre","rut","razon_social"],
					    searchByWord: true,
					    valueProperty: 'id',
					});
				},
			error: function(xhr, status, error) {
			  alert(error+' '+status+' '+xhr);
			  console.log(xhr.responseText);
			}
		});
		
    });
    $('.flexdatalistproductos').on('change:flexdatalist', function(event, set, options) {
	    //console.log($('.flexdatalistproductos').flexdatalist('value'));
	    var total_venta = 0;
	    var total_iva = 0;
	    var total_neto = 0;
	    for (var i = 0; i < $('.flexdatalistproductos').flexdatalist('value').length; i+=1) {
			total_venta += $('.flexdatalistproductos').flexdatalist('value')[i].precio_venta;
			total_iva += $('.flexdatalistproductos').flexdatalist('value')[i].precio_iva;
			total_neto += $('.flexdatalistproductos').flexdatalist('value')[i].precio_neto;
		}

		$('#totalVenta').html(total_venta);
		$('#totalIva').html(total_iva);
		$('#totalNeto').html(total_neto);
		
	});
	$('#wow').submit(function(){
		$('#inputProductos').val(JSON.stringify($('.flexdatalistproductos').flexdatalist('value')));
		$('#inputCliente').val(JSON.parse(JSON.stringify($('.flexdatalistcliente').flexdatalist('value'))));
	});
        
});
</script>
@endsection