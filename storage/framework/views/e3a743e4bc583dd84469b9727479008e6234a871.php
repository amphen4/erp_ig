<?php $__env->startSection('title','Nueva Cotizacion | Ventas'); ?>
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
        <h2>Nueva Cotización </h2>
        
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
        <form id="wow" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="<?php echo e(url('/ventasuser/cotizaciones')); ?>">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" id="inputProductos" name="productos">
          <input type="hidden" id="inputCliente" name="cliente">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cliente:</label>
            <div class="col-md-6 col-sm-6 col-xs-12 input-group">
            	<input   type="text"  required="required" class="flexdatalistcliente form-control col-md-7 col-xs-12">
            	<span class="input-group-btn"><button type="button" id="botonNuevoCliente" class="btn btn-success"><span class="fa fa-plus"></span> Nuevo Cliente</button></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar Producto:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  type="text" class='flexdatalistproductos form-control col-md-7 col-xs-12'   >
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
                      <td ><p><i class="success fa fa-usd"></i><label id="total">0</label> </p></td>
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
                    
                    <input type="number" style="width: 60px;" id="inputDescuento" name="descuento_porciento" max="100" min="0">
              </div>
          </div>
          <div class="form-group">  
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Documento:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class='input-group date' id='Datepicker'>
                        <input type='text' name="fecha" class="form-control" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
              </div>
          </div>
          <div class="form-group">  
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Numero Documento:</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type='text' name="nro" class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Detalles :</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="message" required="required" class="form-control" name="descripcion" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Debes ingresar al menos 20 caracteres"
                            data-parsley-validation-threshold="10"></textarea>
              </div>
          </div>

          <div class="form-group">
          	<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
	          <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>
                      <input type="checkbox" name="despacho" class="flat"> Despacho 
                    </label> 
                	<label>
                      <input type="checkbox" name="diseno" class="flat"> Diseño 
                    </label>
                    <label> 
                      <input type="checkbox" name="montaje" class="flat"> Montaje 
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

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Nombre:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="nombreCliente"  >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">E-mail:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" id="email" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">R.U.T:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="rut"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Comuna, Region:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input type="text"  class="form-control flexdatalistcomunas">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Direccion:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="direccionCliente"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Razón Social:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="razon_social"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Codigo Interno:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="number" class="form-control" id="nro"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">RUT Empresa:</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="empresa"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Giro:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="giro"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 1:<label style="color:red">*</label></label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="fono1"  >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Fono 2:</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" id="fono2"  >
                            </div>
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button  type="button" id="botonGuardar" class="btn btn-primary">Guardar Cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('plugins/flexdatalist')); ?>/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalistcliente').flexdatalist({
     minLength: 1,
     searchIn: ['nombre','razon_social'],
     data: '<?php echo e(url("ventasuser/clientes.json")); ?>',
     allowDuplicateValues: false,
     textProperty: 'Razon Social: {razon_social}, Nombre: {nombre}',
     visibleProperties: ["nombre","rut","razon_social"],
     searchByWord: true,
     valueProperty: 'id',
});
$('.flexdatalistproductos').flexdatalist({
     minLength: 1,
     searchIn: ['nombre','codigo'],
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
        +set.precio_neto.toLocaleString('de-DE')+'</label> </p></td><td ><p><i class="success fa fa-usd"></i><label id="iva">'
        +set.precio_iva.toLocaleString('de-DE')+'</label> </p></td><td ><p><i class="success fa fa-usd"></i><label id="venta">'
        +set.precio_venta.toLocaleString('de-DE')+'</label> </p></td><td ><input style="width: 60px;" id="cantidad" class="form-control input-sm" value="1" min="1" type="number" onchange="actualizarTotalFila(this);actualizarTotal();"></td><td><input type="text" id="medidas" style="width: 100px;" data-inputmask="'+"'mask'"+": '****-****-****-****-****-***'"+'"></td><td><input type="number" style="width: 60px;" id="descuentoFila"  max="100" min="0" onchange="actualizarTotalFila(this);actualizarTotal();" value="0"></td><td ><p><i class="success fa fa-usd"></i><label id="venta2">'
        +set.precio_venta.toLocaleString('de-DE')+'</label> </p></td><td><button class="btn btn-danger btn-xs" onclick="eliminarFila(this)">Eliminar</button></td></tr>';
        $('#body').append(wow);
        actualizarTotal();
      });
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
    $('#total').html(total.toLocaleString('de-DE'));
    
}
function actualizarTotalFila(e){
  
  var total = parseFloat($(e.parentElement.parentElement).find('#cantidad').val().replace('.',''))*parseFloat($(e.parentElement.parentElement).find('#venta').html().replace('.',''));
  if($(e.parentElement.parentElement).find('#descuentoFila').val()){
    total*= 1-(parseFloat($(e.parentElement.parentElement).find('#descuentoFila').val())/100);
  }
  $(e.parentElement.parentElement).find('#venta2').html(total.toLocaleString('de-DE'));
}
</script>
<script>
$(document).ready(function(){
    $("#botonNuevoCliente").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    $("#botonGuardar").on("click", function() {
    	/*alert($('.flexdatalistcomunas').flexdatalist('value').name);*/
    	var comuna = $('.flexdatalistcomunas').flexdatalist('value').name;
    	var region = $('.flexdatalistcomunas').flexdatalist('value').region;
    	var nombre = $('#nombreCliente').val();
    	var direccion = $('#direccionCliente').val();
    	var email = $('#email').val();
    	var razon_social = $('#razon_social').val();
    	var nro = $('#nro').val();
    	var rut = $('#rut').val();
      var giro = $('#giro').val();
      var empresa = $('#empresa').val();
      var fono1 = $('#fono1').val();
      var fono2 = $('#fono2').val();
    	$.ajax({
			type: "POST",
			url: "<?php echo e(url('ventasuser/clientes')); ?>",
			headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			data: 'comuna='+comuna+'&region='+region+'&nombre='+nombre+'&direccion='+direccion+'&email='+email+'&razon_social='+razon_social+'&nro='+nro+'&rut='+rut+'&giro='+giro+'&empresa='+empresa+'&fono1='+fono1+'&fono2='+fono2,
			success: function(json) {
					$('.close').click();
          document.location.reload();
					alert('Cliente agregado exitosamente, si no aparece en la busqueda, apretar F5');
					/*$('.flexdatalistcliente').flexdatalist({
						minLength: 1,
					    searchIn: 'nombre',
					    data: '<?php echo e(url("ventasuser/clientes.json")); ?>',
					    allowDuplicateValues: false,
					    textProperty: '{nombre}, Rut: {rut}, Razon Social: {razon_social}',
					    visibleProperties: ["nombre","rut","razon_social"],
					    searchByWord: true,
					    valueProperty: 'id',
					});*/
				},
			error: function(xhr, status, error) {
			  alert('Error al procesar formulario, porfavor revise los datos que se envian.');
			  console.log(xhr.responseText);
			}
		});
		
    });
    $('.flexdatalistproductos').on('change:flexdatalist', function(event, set, options) {
	    //console.log($('.flexdatalistproductos').flexdatalist('value'));
	    var total_venta = 0;
	    var total_iva = 0;
	    var total_neto = 0;
	    for (var i = 0; i < $('.flexdatalistproductos').flexdatalist('value').length; i+=1) {
			total_venta += $('.flexdatalistproductos').flexdatalist('value')[i].precio_venta;
			total_iva += $('.flexdatalistproductos').flexdatalist('value')[i].precio_iva;
			total_neto += $('.flexdatalistproductos').flexdatalist('value')[i].precio_neto;
		}

		$('#totalVenta').html(total_venta);
		$('#totalIva').html(total_iva);
		$('#totalNeto').html(total_neto);
		
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
		$('#inputCliente').val(JSON.parse(JSON.stringify($('.flexdatalistcliente').flexdatalist('value'))));
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