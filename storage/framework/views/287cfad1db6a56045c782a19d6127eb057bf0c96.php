

<?php $__env->startSection('title','Administrar Usuarios Administradores'); ?>

<?php $__env->startSection('contenido'); ?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Usuarios Admins </h2>
        <button id="botonAgregar" class="btn btn-primary navbar-right" >Agregar nuevo usuario</button>
        <div class="clearfix"></div>
        
      </div>
      <div class="x_content">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
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
            <?php $__currentLoopData = $lista; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr>
              <td><?php echo e($user->name); ?></td>
              <td><?php echo e($user->email); ?></td>
              <td><?php echo e($user->tipo); ?></td>
              <td><button value="<?php echo e($user->id); ?>"  class="btn btn-danger btn-xs ">Eliminar</button></td>
                  
            </tr>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>

      </div>
    </div>
</div>
<!-- Ventana Modal bootstrap -->
<div  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/adminuser/users/admin')); ?>">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
        <?php echo e(csrf_field()); ?>

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
<form id="formEliminar" method="POST" action="<?php echo e(url('/adminuser/users/admin')); ?>" enctype="multipart/form-data">
  <?php echo e(csrf_field()); ?>

  <?php echo e(method_field('DELETE')); ?>

  <input type="hidden" id="inputId" name="id">
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>