<?php $__env->startSection('title',$marca->nombre); ?>

<?php $__env->startSection('contenido'); ?>
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar marca: <?php echo e($marca->nombre); ?> </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" action="<?php echo e(url('adminuser/marcas/').'/'.$marca->id); ?>" data-parsley-validate class="form-horizontal form-label-left">
                      	<?php echo e(csrf_field()); ?>

  					  	        <?php echo e(method_field('PUT')); ?>

                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre marca:</label>

				            <div class="col-md-6">
				                <input  type="text" required="required" value="<?php echo e($marca->nombre); ?>" class="form-control" name="nombre"  >
				            </div>
				        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo e(url('/adminuser/marcas')); ?>" class="btn btn-primary" type="button">Cancelar</a>
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