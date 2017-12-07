<?php $__env->startSection('title','Reportes | Administrador'); ?>
<?php $__env->startSection('contenido'); ?>
<div class="row">
			<div class="col-md-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Historial de Reportes <small>ID: <?php echo e($ot->id); ?></small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                  	<?php $__currentLoopData = $ot->reporte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporte): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <a>
                        <span class="image">
                          <span class="glyphicon glyphicon-save-file" aria-hidden="true" ></span>
                        </span>
                        <span>
                          <span><?php echo e($reporte->filename); ?></span>
                          
                          <span class="time"><?php echo e($reporte->fecha->diffForHumans()); ?></span>

                        </span>
                        
                        <span class="message"><h4>Comentario:</h4>
                        	<?php echo e($reporte->comentario); ?>

                        </span>
                        <hr>
                        <span class="message">
                        <button value="<?php echo e($reporte->id); ?>" class="btn btn-danger btn-xs">Eliminar</button>
                        <button value="<?php echo e($reporte->filename); ?>" class="btn btn-primary btn-xs">Descargar</button>
                    	</span>
                      </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>
            </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
	$('.btn-danger').click(function(){
		if(confirm('Esta seguro ?')){
			$.ajax({
		        type: "POST",
		        url: "<?php echo e(url('adminuser/reportes')); ?>"+'/<?php echo e($ot->id); ?>',
		        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		        data: '_method=DELETE&id='+$(this).val(),
		        success: function(json) {
		          document.location.reload();
		        },
		        error: function(xhr, status, error) {
		          alert('Error en el servidor, porfavor revise los datos que se envian.');
		          console.log(xhr.responseText);
		        }
		      });
		}
	});
	$('.btn-primary').click(function(){
		window.open('<?php echo e(url('adminuser')); ?>'+'/descargarReporte/'+$(this).val(),'_blank');
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>