<?php $__env->startSection('title',$cliente->razon_social); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('plugins/flexdatalist')); ?>/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Cliente: <?php echo e($cliente->razon_social); ?> </h2>
                    
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
                    <br />
                    <form id="demo-form2" method="POST" action="<?php echo e(url('adminuser/clientes/').'/'.$cliente->id); ?>" data-parsley-validate class="form-horizontal form-label-left">
                      	<?php echo e(csrf_field()); ?>

  					  	<?php echo e(method_field('PUT')); ?>

  					  	<input name="comuna" id="inputComuna" type="hidden" >
  					  	<input name="region" id="inputRegion" type="hidden" >
                      	<div class="form-group">
				            <label  class="col-md-4 control-label">Nombre Cliente:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" name="nombre" required="required" value="<?php echo e($cliente->nombre); ?>" class="form-control" id="nombreCliente"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Email:</label>

				            <div class="col-md-6">
				                <input  type="email" name="email" value="<?php echo e($cliente->email); ?>"  required="required" class="form-control" id="email"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Rut Cliente:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" name="rut" value="<?php echo e($cliente->rut); ?>" class="form-control" id="rut"  >
				            </div>
				        </div>
				        <div class="form-group">
				            <label  class="col-md-4 control-label">Comuna, Region:<label style="color:red">*</label></label>

				            <div class="col-md-6">
				                <input  type="text" required="required" <?php if($cliente->comuna): ?> value="<?php echo e($cliente->comuna.', '.$cliente->region); ?>" <?php endif; ?> class="form-control flexdatalistcomunas"  >
				            </div>
				        </div>
				        <div class="form-group">
                            <label  class="col-md-4 control-label">Direccion:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="direccion" class="form-control" value="<?php echo e($cliente->direccion); ?>" id="direccionCliente"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Razón Social:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="razon_social" class="form-control" value="<?php echo e($cliente->razon_social); ?>" id="razon_social"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Codigo Interno:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="number" name="nro" class="form-control" id="nro" value="<?php echo e($cliente->nro); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">RUT Empresa:</label>
                            <div class="col-md-6">
                                <input  type="text" name="empresa" class="form-control" id="empresa" value="<?php echo e($cliente->empresa); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Giro:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="giro" class="form-control" id="giro" value="<?php echo e($cliente->giro); ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 1:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" name="fono1" class="form-control" id="fono1" value="<?php echo e($cliente->fono1); ?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 2:</label>
                            <div class="col-md-6">
                                <input  type="text" name="fono2" class="form-control" id="fono2" value="<?php echo e($cliente->fono2); ?>" >
                            </div>
                        </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="<?php echo e(url('/adminuser/clientes')); ?>" class="btn btn-primary" type="button">Cancelar</a>
                          <button type="submit"  class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('plugins/flexdatalist')); ?>/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalistcomunas').flexdatalist({
     minLength: 1,
     searchIn: 'name',
     data: '<?php echo e(url("comunas.json")); ?>',
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>