

<?php $__env->startSection('title',$inventario->nombre); ?>

<?php $__env->startSection('contenido'); ?>
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar inventario: <?php echo e($inventario->nombre); ?> </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" action="<?php echo e(url('adminuser/inventarios/').'/'.$inventario->id); ?>" data-parsley-validate class="form-horizontal form-label-left">
                    	<?php echo e(csrf_field()); ?>

      		  	        <?php echo e(method_field('PUT')); ?>

                    	<div class="form-group">
      				            <label  class="col-md-4 control-label">Nombre inventario:</label>

      				            <div class="col-md-6">
      				                <input  type="text" required="required" value="<?php echo e($inventario->nombre); ?>" class="form-control" name="nombre"  >
      				            </div>
      				        </div>
                      <div class="form-group">
                          <label  class="col-md-4 control-label">Sucursal:</label>

                          <div class="col-md-6">
                              <select name="sucursal">
                                <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($sucursal->id == $inventario->sucursal_id): ?>
                                <option selected="selected" value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre.' - '.$sucursal->direccion); ?></option>
                                <?php else: ?>
                                <option value="<?php echo e($sucursal->id); ?>"><?php echo e($sucursal->nombre.' - '.$sucursal->direccion); ?></option>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                          </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo e(url('/adminuser/inventarios')); ?>" class="btn btn-primary" type="button">Cancelar</a>
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>