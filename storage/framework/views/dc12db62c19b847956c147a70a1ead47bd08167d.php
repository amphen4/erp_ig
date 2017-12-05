<?php $__env->startSection('title','Cotizaciones | Ventas'); ?>

<?php $__env->startSection('css'); ?>
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
                          
                          <th>Cliente</th>
                          <th>Productos</th>
                          <th>Neto</th>
                          <th style="width:100px">Descuento al Total(%)</th>
                          <th>Total</th>
                          <th>Vendedor</th>
                          <th>Estado O.T</th>
                          <th>ID O.T</th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php $__currentLoopData = $filas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fila): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          
                          <td><?php echo e($fila->cliente->nombre); ?></td>
                          <td> <button value="<?php echo e($fila->id); ?>" type="button" class="btn btn-primary btn-xs botonDetalle" data-toggle="modal" data-target=".bs-example-modal-lg">Ver Detalle</button></td>
                          <td><?php echo e('$'.number_format($fila->valor_neto,0,",",".")); ?></td>
                          <?php if($fila->descuento > 0): ?>
                          <td><?php echo e($fila->descuento.'%'); ?></td>
                          <?php else: ?>
                          <td>-</td>
                          <?php endif; ?>
                          <td><strong><?php echo e('$'.number_format($fila->valor_total,0,",",".")); ?></strong></td>
                          <td><?php echo e($fila->ventasuser->name); ?></td>
                          <?php if($fila->ot->otestado->nombre == 'PENDIENTE'): ?>
                          <td><?php echo e($fila->ot->otestado->nombre); ?>  <a href="<?php echo e(url('/ventasuser/cotizaciones').'/'.$fila->id.'/edit'); ?>"  class="btn btn-warning btn-xs ">Editar</a></td>
                          <?php else: ?>
                          <td><?php echo e($fila->ot->otestado->nombre); ?></td>
                          <?php endif; ?>
                          
                          <td><?php echo e($fila->ot->id); ?></td>
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

	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
	      </button>
	      <h4 class="modal-title" id="myModalLabel2">Detalle Productos</h4>
	    </div>
	    <div class="modal-body">
	      <ul id="ul">
          <li class="xd"></li>
          <li class="xd"></li>
          <li class="xd"></li>
        </ul>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
	    </div>

	  </div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
<script>
  $('.botonDetalle').on('click', function (e) {
    $.ajax({
      type: "GET",
      url: "<?php echo e(url('ventasuser/cotizacion')); ?>"+"/"+$(this).val(),
      success: function(json) {
        $('.xd').remove();
        for(i=0; i<json.length; i++)
        {
          $('#ul').append('<li class="xd">'+json[i].cantidad+' | '+json[i].nombre+' | '+json[i].medidas+' | Descuento ('+json[i].descuento+'%)</li>');
        }
        
      },
      error: function(xhr, status, error) {
        alert(error+' '+status+' '+xhr);
        console.log(xhr.responseText);
      }
    });
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('ventasuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>