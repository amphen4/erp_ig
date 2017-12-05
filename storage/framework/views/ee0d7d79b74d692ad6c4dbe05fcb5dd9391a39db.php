

<?php $__env->startSection('title',$producto->nombre); ?>

<?php $__env->startSection('contenido'); ?>
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Producto: <?php echo e($producto->nombre); ?> </h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="POST" action="<?php echo e(url('adminuser/productos/').'/'.$producto->id); ?>" data-parsley-validate class="form-horizontal form-label-left">
                      	<?php echo e(csrf_field()); ?>

  					  	<?php echo e(method_field('PUT')); ?>

                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre producto:</label>

				            <div class="col-md-6">
				                <input  type="text" required="required" value="<?php echo e($producto->nombre); ?>" class="form-control" name="nombre"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Stock:</label>

				            <div class="col-md-6">
				                <input  type="number" value="<?php echo e($producto->stock); ?>" min="0" required="required" class="form-control" name="stock"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Codigo Interno:</label>

				            <div class="col-md-6">
				                <input  type="number"  value="<?php echo e($producto->codigo); ?>" required="required" class="form-control" name="codigo_interno"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Marca:</label>

				            <div class="col-md-6">
				                <select name="marca">
				                  <?php $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                  <?php if($producto->marca->nombre == $marca->nombre): ?>
				                  <option selected="selected" value="<?php echo e($marca->id); ?>"><?php echo e($marca->nombre); ?></option>
				                  <?php else: ?>
				                  <option value="<?php echo e($marca->id); ?>"><?php echo e($marca->nombre); ?></option>
				                  <?php endif; ?>
				                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Categoria:</label>

				            <div class="col-md-6">
				                <select name="categoria">
				                  <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                  <?php if($producto->categoria->nombre == $categoria): ?>
				                  <option selected="selected" value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
				                  <?php else: ?>
				                  <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->nombre); ?></option>
				                  <?php endif; ?>

				                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Inventario:</label>

				            <div class="col-md-6">
				                <select name="inventario">
				                  <?php $__currentLoopData = $inventarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				                  <?php if($producto->inventario->nombre): ?>
				                  <option selected="selected" value="<?php echo e($inventario->id); ?>"><?php echo e($inventario->nombre); ?></option>
				                  <?php else: ?>
				                  <option value="<?php echo e($inventario->id); ?>"><?php echo e($inventario->nombre); ?></option>
				                  <?php endif; ?>
				                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				                </select>
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Precio Neto:</label>

				            <div class="col-md-6">
				                <input  value="<?php echo e($producto->precio_neto); ?>" type="number" min="0" required="required" class="form-control" name="precio_neto"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Precio Venta:</label>

				            <div class="col-md-6">
				                <input value="<?php echo e($producto->precio_venta); ?>"  type="number" min="0" required="required" class="form-control" name="precio_venta"  >
				            </div>
				        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo e(url('/adminuser/productos')); ?>" class="btn btn-primary" type="button">Cancelar</a>
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