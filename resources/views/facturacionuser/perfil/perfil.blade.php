@extends('facturacionuser.layout.gentelella')
@section('contenido')

<!-- page content -->
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Perfil de Usuario</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  {{ $error }}
                </div>
                @endforeach
            @endif
            <div class="col-md-6 col-sm-6 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  
                  <img class="img-responsive avatar-view" src="{{ url('facturacionuser/img-perfil/facturacion-'.Auth::user()->id.'.jpg') }}" alt="Avatar" title="imagen de perfil">
                  
                </div>
              </div>
              <h3>{{Auth::user()->name}}</h3>

              <ul class="list-unstyled user_data">
                
                <li><i class="fa fa-user user-profile-icon"></i> Nombre:{{Auth::user()->name}}
                </li>
                <li>
                  <i class="fa fa-envelope user-profile-icon"></i> {{Auth::user()->email}}
                </li>
                <li class="m-top-xs">
                  <i class="fa fa-phone   user-profile-icon"></i> Area: {{Auth::user()->tipo}}
                </li>
              </ul>

              <a id="botonEditar" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Editar Perfil</a>
              <br />

            </div>
            
          </div>
        </div>
      </div>
    </div>


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/facturacionuser/perfil') }}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
      </div>
      <div class="modal-body">
        
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">E-mail:</label>

                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Imagen de Perfil (jpg, max. 2 MB)</label>

                            <div class="col-md-6">
                                <input  type="file" class="form-control" name="perfil" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Nueva Contraseña</label>

                            <div class="col-md-6">
                                <input  type="password" class="form-control" name="password" placeholder="Dejar en blanco si no desea cambiar contraseña">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Repita Constraseña</label>

                            <div class="col-md-6">
                                <input  type="password" class="form-control" name="password_confirmation" placeholder="Dejar en blanco si no desea cambiar contraseña">
                            </div>
                        </div>

                        
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('js')
$<script>
$(document).ready(function(){
    $("#botonEditar").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    
        
});
</script>
@endsection