@extends('produccionuser.layout.gentelella')

@section('title',$categoria->nombre)

@section('contenido')
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Categoria: {{$categoria->nombre}} </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" action="{{url('produccionuser/categorias/').'/'.$categoria->id}}" data-parsley-validate class="form-horizontal form-label-left">
                      	{{ csrf_field() }}
  					  	{{ method_field('PUT') }}
                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre categoria:</label>

				            <div class="col-md-6">
				                <input  type="text" required="required" value="{{$categoria->nombre}}" class="form-control" name="nombre"  >
				            </div>
				        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{url('/produccionuser/categorias')}}" class="btn btn-primary" type="button">Cancelar</a>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
@endsection