<?php $__env->startSection('title','Editar Cotizacion # '.$cotizacion->id.' | Ventas'); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('plugins/flexdatalist')); ?>/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<!-- bootstrap-daterangepicker -->
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Editar Cotización # <?php echo e($cotizacion->id); ?></h2>
        
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
        <br>
          
        
        <form id="wow" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="<?php echo e(url('/ventasuser/cotizaciones').'/'.$cotizacion->id); ?>">
          <?php echo e(csrf_field()); ?>

          <?php echo e(method_field('PUT')); ?>

          <input type="hidden" id="inputProductos" name="productos">
          <input type="hidden" id="inputCliente" value="<?php echo e($cotizacion->cliente->id); ?>" name="cliente">
          <div class="bs-example form-group" data-example-id="simple-jumbotron">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Comentario Orden de Trabajo PENDIENTE:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="jumbotron">
              <p><?php echo e($cotizacion->ot->comentario); ?></p>
              <p><?php echo e($cotizacion->ot->adminuser->name); ?>.</p>
            </div>
          </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cliente:</label>
            <div class="col-md-6 col-sm-6 col-xs-12 input-group">
            	<input   type="text" disabled  value="<?php echo e($cotizacion->cliente->nombre); ?>" class=" form-control col-md-7 col-xs-12">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar Producto:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  type="text" class='flexdatalistproductos form-control col-md-7 col-xs-12'  >
              
            </div>
          </div>
          <div class="form-group">
            <br>
            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h2>Productos</h2>
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th>ID</th>
                      <th class="column-title">Producto</th>
                      <th class="column-title">Precio Costo</th>
                      <th class="column-title">IVA (19%)</th>
                      <th class="column-title">Precio Venta</th>
                      <th class="column-title">Cantidad</th>
                      <th class="column-title">Medidas</th>
                      <th class="column-title">Descuento(%)</th>
                      <th class="column-title">Total Producto</th>
                      <th class="column-title" ></th>
                    </tr>
                  </thead>

                  <tbody id="body">
                    <?php $__currentLoopData = $cotizacion->producto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="even pointer">
                      <td><p id="id"><?php echo e($producto->id); ?></p></td>
                      <td><p id="producto"><?php echo e($producto->nombre); ?></p></td>
                      <td><p><i class="success fa fa-usd"></i><label id="neto"><?php echo e(number_format($producto->precio_neto,0,",",".")); ?></label></p></td>
                      <td><p><i class="success fa fa-usd"></i><label id="iva"><?php echo e(number_format($producto->precio_iva,0,",",".")); ?></label></p></td>
                      <td><p><i class="success fa fa-usd"></i><label id="venta"><?php echo e(number_format($producto->precio_venta,0,",",".")); ?></label></p></td>
                      <td><input style="width: 60px;" id="cantidad" class="form-control input-sm" value="<?php echo e($producto->pivot->cantidad); ?>" min="1" type="number" onchange="actualizarTotalFila(this);actualizarTotal();"></td>
                      <td><input type="text" id="medidas" style="width: 100px;" value="<?php echo e($producto->pivot->medidas); ?>"></td>
                      <td><input type="number" style="width: 60px;" id="descuentoFila" max="100" min="0" value="<?php echo e($producto->pivot->descuento); ?>" onchange="actualizarTotalFila(this);actualizarTotal();"></td>
                      <td><p><i class="success fa fa-usd"></i><label id="venta2"><?php echo e(number_format($producto->precio_venta*$producto->pivot->cantidad*(1-($producto->pivot->descuento/100)),0,",",".")); ?></label></p></td>
                      <td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">Eliminar</button></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td></td>
                      <td>  </td>
                      <td>  </td>
                      <td>  </td>
                      <td>  </td>
                      <td>  </td>
                      <td>  </td>
                      <td> TOTAL Cotizacion </td>
                      <td ><p><i class="success fa fa-usd"></i><label id="total"><?php echo e($cotizacion->valor_total); ?></label> </p></td>
                      <td id="avisoDescuento"></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descuento al Total (%):</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    
                    <input type="number" style="width: 60px;" value="<?php echo e($cotizacion->descuento); ?>" id="inputDescuento" name="descuento_porciento" max="100" min="0">
              </div>
          </div>
          <div class="form-group">  
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Documento:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class='input-group date' id='Datepicker'>
                        <input type='text' name="fecha" value="<?php echo e($cotizacion->fecha); ?>" class="form-control" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
              </div>
          </div>
          <div class="form-group">  
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero Documento:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type='text' name="nro" value="<?php echo e($cotizacion->nro); ?>" class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalles :</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="message" required="required" class="form-control" name="descripcion" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Debes ingresar al menos 20 caracteres"
                            data-parsley-validation-threshold="10"><?php echo e($cotizacion->descripcion); ?></textarea>
              </div>
          </div>

          <div class="form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
	          <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="despacho"  <?php if($cotizacion->despacho==true): ?> <?php echo e('checked'); ?> <?php endif; ?> class="flat"> Despacho 
                    </label> 
                	<label>
                      <input type="checkbox" name="diseno"  <?php if($cotizacion->diseno==true): ?> <?php echo e('checked'); ?> <?php endif; ?> class="flat"> Diseño 
                    </label>
                    <label> 
                      <input type="checkbox" name="montaje" <?php if($cotizacion->montaje==true): ?> <?php echo e('checked'); ?> <?php endif; ?> class="flat"> Montaje 
                    </label> 
	          </div>
	        </div>
          
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
              <button type="submit" class="btn btn-primary">Enviar</button>
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

$('.flexdatalistproductos').flexdatalist({
     minLength: 1,
     searchIn: 'nombre',
     data: '<?php echo e(url("ventasuser/productos.json")); ?>',
     textProperty: '{nombre},  Precio Venta: ${precio_venta}',
     visibleProperties: ["nombre","stock","precio_venta"],
     searchByWord: true,
     valueProperty: '*',
     selectionRequired: true,
});
$('.flexdatalistproductos').on('select:flexdatalist', function(event, set, options) {
        console.log('Producto '+set.nombre+' agregado.');
        var wow = '<tr class="even pointer"><td ><p id="id">'
        +set.id+'</p> </td><td ><p id="producto">'
        +set.nombre+'</p> </td><td ><p><i class="success fa fa-usd"></i><label id="neto">'
        +set.precio_neto.toLocaleString()+'</label> </p></td><td ><p><i class="success fa fa-usd"></i><label id="iva">'
        +set.precio_iva.toLocaleString()+'</label> </p></td><td ><p><i class="success fa fa-usd"></i><label id="venta">'
        +set.precio_venta.toLocaleString()+'</label> </p></td><td ><input style="width: 60px;" id="cantidad" class="form-control input-sm" value="1" min="1" type="number" onchange="actualizarTotalFila(this);actualizarTotal();"></td><td><input type="text" id="medidas" style="width: 100px;" data-inputmask="'+"'mask'"+": '****-****-****-****-****-***'"+'"></td><td><input type="number" style="width: 60px;" id="descuentoFila"  max="100" min="0" onchange="actualizarTotalFila(this);actualizarTotal();" value="0"></td><td ><p><i class="success fa fa-usd"></i><label id="venta2">'
        +set.precio_venta.toLocaleString()+'</label> </p></td><td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">Eliminar</button></td></tr>';
        $('#body').append(wow);
        actualizarTotal();
      });

function eliminarFila(e) {
    //console.log(e.parentElement.parentElement);
    $(e.parentElement.parentElement).remove();
    actualizarTotal();
}
function actualizarTotal() {
    var total = 0;
    $('#body  > tr').each(function() {
      total += parseFloat($(this).find('#venta').html().replace('.','')) *
      parseFloat($(this).find('#cantidad').val().replace('.',''))*(1-(parseFloat($(this).find('#descuentoFila').val())/100));
      
    });
    if($('#inputDescuento').val()){
      var aux = 1 - (parseInt($('#inputDescuento').val())/100);
      total *= aux;
      if($('#inputDescuento').val() != '0'){
        $('#avisoDescuento').html('Descuento (%'+$('#inputDescuento').val()+')');
      }
      else{
        $('#avisoDescuento').html('');
      }
      
    }
    $('#total').html(total.toLocaleString());
    
}
function actualizarTotalFila(e){
  
  var total = parseFloat($(e.parentElement.parentElement).find('#cantidad').val().replace('.',''))*parseFloat($(e.parentElement.parentElement).find('#venta').html().replace('.',''));
  if($(e.parentElement.parentElement).find('#descuentoFila').val()){
    total*= 1-(parseFloat($(e.parentElement.parentElement).find('#descuentoFila').val())/100);
  }
  $(e.parentElement.parentElement).find('#venta2').html(total.toLocaleString());
}
</script>
<script>
$(document).ready(function(){
  $('.flexdatalistproductos').on('change:flexdatalist', function(event, set, options) {
      actualizarTotal();
	    //console.log($('.flexdatalistproductos').flexdatalist('value'));
      /*
	    var total_venta = 0;
	    var total_iva = 0;
	    var total_neto = 0;
	    for (var i = 0; i < $('.flexdatalistproductos').flexdatalist('value').length; i+=1) {
			total_venta += $('.flexdatalistproductos').flexdatalist('value')[i].precio_venta;
			total_iva += $('.flexdatalistproductos').flexdatalist('value')[i].precio_iva;
			total_neto += $('.flexdatalistproductos').flexdatalist('value')[i].precio_neto;
      
		

		$('#totalVenta').html(total_venta);
		$('#totalIva').html(total_iva);
		$('#totalNeto').html(total_neto);
		*/
	});
	$('#wow').submit(function(){
    var arreglo = new Array();
    $('#body  > tr').each(function() {
      var objeto = {
        id: parseInt($(this).find('#id').html()),
        cantidad: parseInt($(this).find('#cantidad').val()),
        medidas: $(this).find('#medidas').val(),
        descuento: parseInt($(this).find('#descuentoFila').val())
      };
      arreglo.push(objeto);
      
      
    });
		$('#inputProductos').val(JSON.stringify(arreglo));
	});
  // Desactiva hacer submit apretando la tecla enter
  $('input[type=number]').bind('keypress', function(e){
      if ( e.which == 13 ) return false;
  });
  $('.flexdatalistcliente').bind('keypress', function(e){
      if ( e.which == 13 ) return false;
  });
  $('.flexdatalistproductos').bind('keypress', function(e){
      if ( e.which == 13 ) return false;
  });  
  $('#inputDescuento').change(function() {
    actualizarTotal();
  });
  actualizarTotal();
});
</script>

<!-- bootstrap-daterangepicker -->
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- jquery.inputmask -->
<script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script>
$('#Datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('ventasuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>