@extends('adminuser.layout.gentelella')

@section('title',$cliente->razon_social)
@section('css')
<link href="{{asset('plugins/flexdatalist')}}/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
@endsection
@section('contenido')
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Cliente: {{$cliente->razon_social}} </h2>
                    
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
                    <br />
                    <form id="demo-form2" method="POST" action="{{url('adminuser/clientes/').'/'.$cliente->id}}" data-parsley-validate class="form-horizontal form-label-left">
                      	{{ csrf_field() }}
  					  	{{ method_field('PUT') }}
  					  	<input name="comuna" id="inputComuna" type="hidden" >
  					  	<input name="region" id="inputRegion" type="hidden" >
                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre Cliente:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" name="nombre" required="required" value="{{$cliente->nombre}}" class="form-control" id="nombreCliente"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Email:</label>

				            <div class="col-md-6">
				                <input  type="email" name="email" value="{{$cliente->email}}"  required="required" class="form-control" id="email"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Rut Cliente:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" name="rut" value="{{$cliente->rut}}" class="form-control" id="rut"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Comuna, Region:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" required="required" @if($cliente->comuna) value="{{$cliente->comuna.', '.$cliente->region}}" @endif class="form-control flexdatalistcomunas"  >
				            </div>
				        </div>
				        <div class="form-group">
                            <label  class="col-md-4 control-label">Direccion:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}" id="direccionCliente"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Razón Social:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="razon_social" class="form-control" value="{{$cliente->razon_social}}" id="razon_social"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Codigo Interno:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="number" name="nro" class="form-control" id="nro" value="{{$cliente->nro}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">RUT Empresa:</label>
                            <div class="col-md-6">
                                <input  type="text" name="empresa" class="form-control" id="empresa" value="{{$cliente->empresa}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Giro:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="giro" class="form-control" id="giro" value="{{$cliente->giro}}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 1:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="fono1" class="form-control" id="fono1" value="{{$cliente->fono1}}" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 2:</label>
                            <div class="col-md-6">
                                <input  type="text" name="fono2" class="form-control" id="fono2" value="{{$cliente->fono2}}" >
                            </div>
                        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{url('/adminuser/clientes')}}" class="btn btn-primary" type="button">Cancelar</a>
                          <button type="submit"  class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
@section('js')
<script src="{{asset('plugins/flexdatalist')}}/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalistcomunas').flexdatalist({
     minLength: 1,
     searchIn: 'name',
     data: '{{url("comunas.json")}}',
     groupBy: 'region',
     visibleProperties: ["name"],
     textProperty: '{name}, {region}',
     searchByWord: true,
     valueProperty: '*'
});
$("#demo-form2").on("submit", function() {
    	/*alert($('.flexdatalistcomunas').flexdatalist('value').name);*/
    	$('#inputComuna').val($('.flexdatalistcomunas').flexdatalist('value').name);
    	$('#inputRegion').val($('.flexdatalistcomunas').flexdatalist('value').region);
    	
    	
    });
</script>
@endsection