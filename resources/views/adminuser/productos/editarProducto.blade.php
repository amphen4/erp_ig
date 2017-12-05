@extends('adminuser.layout.gentelella')

@section('title',$producto->nombre)

@section('contenido')
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Producto: {{$producto->nombre}} </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" action="{{url('adminuser/productos/').'/'.$producto->id}}" data-parsley-validate class="form-horizontal form-label-left">
                      	{{ csrf_field() }}
  					  	{{ method_field('PUT') }}
                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre producto:</label>

				            <div class="col-md-6">
				                <input  type="text" required="required" value="{{$producto->nombre}}" class="form-control" name="nombre"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Stock:</label>

				            <div class="col-md-6">
				                <input  type="number" value="{{$producto->stock}}" min="0" required="required" class="form-control" name="stock"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Codigo Interno:</label>

				            <div class="col-md-6">
				                <input  type="number"  value="{{$producto->codigo}}" required="required" class="form-control" name="codigo_interno"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Marca:</label>

				            <div class="col-md-6">
				                <select name="marca">
				                  @foreach($marcas as $marca)
				                  @if($producto->marca->nombre == $marca->nombre)
				                  <option selected="selected" value="{{$marca->id}}">{{$marca->nombre}}</option>
				                  @else
				                  <option value="{{$marca->id}}">{{$marca->nombre}}</option>
				                  @endif
				                  @endforeach
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Categoria:</label>

				            <div class="col-md-6">
				                <select name="categoria">
				                  @foreach($categorias as $categoria)
				                  @if($producto->categoria->nombre == $categoria)
				                  <option selected="selected" value="{{$categoria->id}}">{{$categoria->nombre}}</option>
				                  @else
				                  <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
				                  @endif

				                  @endforeach
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Inventario:</label>

				            <div class="col-md-6">
				                <select name="inventario">
				                  @foreach($inventarios as $inventario)
				                  @if($producto->inventario->nombre)
				                  <option selected="selected" value="{{$inventario->id}}">{{$inventario->nombre}}</option>
				                  @else
				                  <option value="{{$inventario->id}}">{{$inventario->nombre}}</option>
				                  @endif
				                  @endforeach
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Precio Neto:</label>

				            <div class="col-md-6">
				                <input  value="{{$producto->precio_neto}}" type="number" min="0" required="required" class="form-control" name="precio_neto"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Precio Venta:</label>

				            <div class="col-md-6">
				                <input value="{{$producto->precio_venta}}"  type="number" min="0" required="required" class="form-control" name="precio_venta"  >
				            </div>
				        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{url('/adminuser/productos')}}" class="btn btn-primary" type="button">Cancelar</a>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection
