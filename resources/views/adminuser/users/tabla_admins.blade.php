@extends('adminuser.layout.gentelella')

@section('title','Administrar Usuarios Administradores')

@section('contenido')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Usuarios Admins </h2>
        <button id="botonAgregar" class="btn btn-primary navbar-right" >Agregar nuevo usuario</button>
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
        <table class="table table-bordered">
          <thead>
            <tr>
            
              <th>Nombre </th>
              <th>E-mail</th>
              <th>Area</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lista as $user)
            
            <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->tipo}}</td>
              <td><button value="{{$user->id}}"  class="btn btn-danger btn-xs ">Eliminar</button></td>
                  
            </tr>
            
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
</div>
<!-- Ventana Modal bootstrap -->
<div  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/adminuser/users/admin') }}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
            <label  class="col-md-4 control-label">Nombre:</label>

            <div class="col-md-6">
                <input  type="text" required="required" class="form-control" name="name"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">E-mail:</label>

            <div class="col-md-6">
                <input  type="email"  required="required" class="form-control" name="email"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Area:</label>

            <div class="col-md-6">
                <select name="tipo">
                  <option value="ventas">Ventas</option>
                  <option value="produccion">Produccion</option>
                  <option value="facturacion">Facturacion</option>
                  <option value="all">All</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Contraseña:</label>

            <div class="col-md-6">
                <input  type="password" required="required" class="form-control" name="password" placeholder="(entre 4 y 100 caracteres)" >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Repita contraseña:</label>

            <div class="col-md-6">
                <input  type="password" required="required" class="form-control" name="password_confirmation" placeholder="(entre 4 y 100 caracteres)" >
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit"  class="btn btn-success" id="btnGUARDAR">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<form id="formEliminar" method="POST" action="{{url('/adminuser/users/admin')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
  <input type="hidden" id="inputId" name="id">
</form>
@endsection
@section('js')
<script>
$(document).ready(function(){
    $("#botonAgregar").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    $('.btn-danger').click(function(){
      if(confirm('Esta seguro?'))
      {
        $('#inputId').val($(this).val());
        $('#formEliminar').submit();
      }  
  });
  });


</script>
@endsection