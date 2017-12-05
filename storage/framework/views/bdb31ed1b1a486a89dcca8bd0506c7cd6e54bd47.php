<?php $__env->startSection('contenido'); ?>

<!-- page content -->
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Perfil de Usuario</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <?php echo e($error); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <div class="col-md-6 col-sm-6 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  
                  <img class="img-responsive avatar-view" src="<?php echo e(url('adminuser/img-perfil/'.Auth::user()->id)); ?>" alt="Avatar" title="imagen de perfil">
                  
                </div>
              </div>
              <h3><?php echo e(Auth::user()->name); ?></h3>

              <ul class="list-unstyled user_data">
                
                <li><i class="fa fa-user user-profile-icon"></i> Nombre:<?php echo e(Auth::user()->name); ?>

                </li>
                <li>
                  <i class="fa fa-envelope user-profile-icon"></i> <?php echo e(Auth::user()->email); ?>

                </li>
                <li class="m-top-xs">
                  <i class="fa fa-phone   user-profile-icon"></i> Area: <?php echo e(Auth::user()->tipo); ?>

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
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/adminuser/perfil')); ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar Perfil</h4>
      </div>
      <div class="modal-body">
        
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="<?php echo e(Auth::user()->name); ?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">E-mail:</label>

                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" value="<?php echo e(Auth::user()->email); ?>">
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
$<script>
$(document).ready(function(){
    $("#botonEditar").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    
        
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>