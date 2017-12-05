<?php $__env->startSection('title','Clientes | Administrador'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('plugins/flexdatalist')); ?>/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<!-- Datatables -->
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo e($titulo_tabla); ?></h2>
                    <button id="botonAgregar" class="btn btn-primary navbar-right" >Agregar nuevo cliente</button>
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
                    <p class="text-muted font-13 m-b-30">
                      <?php echo e($descripcion_tabla); ?>

                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>Codigo</th>
                          <th>Razon Social</th>
                          <th>Nombre</th>
                          <th>Email</th>
                          <th>RUT</th>
                          <th>Direccion</th>
                          
                          <th>RUT Empresa</th>
                          <th>Fono 1</th>
                          <th>Fono 2</th>
                          <th>Giro</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php $__currentLoopData = $filas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><a href="<?php echo e(url('/adminuser/clientes').'/'.$fila->id.'/edit'); ?>"  class="btn btn-warning btn-xs ">Editar</a></td>
                          <td><?php echo e($fila->nro); ?></td>
                          <td><?php echo e($fila->razon_social); ?></td>
                          <td><?php echo e($fila->nombre); ?></td>
                          <td><?php echo e($fila->email); ?></td>
                          <td><?php echo e($fila->rut); ?></td>
                          <td><?php echo e($fila->direccion.', '.$fila->comuna.', '.$fila->region.'.'); ?></td>
                          
                          <td><?php echo e($fila->empresa); ?></td>
                          <td><?php echo e($fila->fono1); ?></td>
                          <td><?php echo e($fila->fono2); ?></td>
                          <td><?php echo e($fila->giro); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" action="<?php echo e(url('adminuser/clientes')); ?>" method="POST" role="form" id="formClientes">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="comuna" id="inputComuna">
                        <input type="hidden" name="region" id="inputRegion">
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Nombre:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="nombre"  >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">E-mail:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">R.U.T:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="rut"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Comuna, Region:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input type="text"   class="form-control flexdatalistcomunas">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Direccion:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="direccion"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Razón Social:</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="razon_social"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Codigo Interno:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="nro"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">RUT Empresa:</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="empresa"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Giro:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="giro"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 1:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="fono1"  >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 2:</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="fono2"  >
                            </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  type="submit" id="botonGuardar" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
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
</script>
<script>
$(document).ready(function(){
    $("#botonAgregar").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    $("#formClientes").on("submit", function() {
    	/*alert($('.flexdatalistcomunas').flexdatalist('value').name);*/
    	$('#inputRegion').val($('.flexdatalistcomunas').flexdatalist('value').region);
    	$('#inputComuna').val($('.flexdatalistcomunas').flexdatalist('value').name);
    	

	});
});
</script>
<!-- Datatables -->
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>