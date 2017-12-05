<?php $__env->startSection('css'); ?>
	<!-- FullCalendar -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
		  <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Eventos </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div id='calendar'></div>

                  </div>
                </div>
              </div>
              <!-- Widget del Clima wow -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>El Clima para Hoy</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div id="contenido_tiempo" class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div id="titulo" class="temperature">

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="weather-icon">
                          
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <div id="textoTiempo" class="weather-text">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="weather-text pull-right">
                        <h3 id="temperaturas"></h3>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    
                  </div>
                </div>

              </div>
            </div>

          </div>
          
          	  
         
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Nuevo evento</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form">
              	<?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nota</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="title" name="title"></textarea>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary antosubmit">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel2">Editar evento</h4>
          </div>
          <div class="modal-body">

            <div id="testmodal2" style="padding: 5px 20px;">
              <form id="antoform2" class="form-horizontal calender" role="form">
              	<?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nota</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" style="height:55px;" id="title2" name="title2"></textarea>
                  </div>
                </div>

              </form>
            </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-danger antosubmit3">Eliminar</button>
            <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary antosubmit2">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

	<!-- FullCalendar -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/fullcalendar/dist/lang/es.js"></script>
    <script>
    	 /* CALENDARIO (wow) */
		  $(document).ready(function() { 
		    
					
				if( typeof ($.fn.fullCalendar) === 'undefined'){ return; }
				console.log('init_calendar');
					
				var date = new Date(),
					d = date.getDate(),
					m = date.getMonth(),
					y = date.getFullYear(),
					started,
					categoryClass;

				var calendar = $('#calendar').fullCalendar({
				  locale: 'es',
				  header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				  },
				  events: "<?php echo e(url('adminuser/eventos')); ?>",
				  eventRender: function(event, element, view) {
				  	
				    if (event.allDay === 'true') {

				     event.allDay = true;

				    } else {

				     event.allDay = false;

				    }

				   },
				  selectable: true,
				  selectHelper: true,
				  select: function(start, end, allDay) { //selecciono un espacio en blanco
					$('#fc_create').click();

					started = start;
					ended = end;
					$(".antosubmit").on("click", function() {

					  var title = $("#title").val();
					  //alert(title);
					  if (end) {
						ended = end;
					  }

					  categoryClass = $("#event_type").val();

					  if (title) {
					  	
					  	 var start = moment(started).format("Y-MM-DD HH:mm:ss");
					  	 
   						 var end = moment(ended).format("Y-MM-DD HH:mm:ss");
					  	 $.ajax({

							url: '<?php echo e(url("adminuser/enviarEvento")); ?>',
							headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'title='+ title+'&start='+ start +'&end='+ end,

							type: "POST",
							success: function(json){console.log(json.wow);}, 
							error: function(xhr, status, error) {
							  alert(error+' '+status+' '+xhr);
							  console.log(xhr.responseText);
							}

						 });
						calendar.fullCalendar('renderEvent', {
							title: title,
							start: started,
							end: end,
							allDay: allDay,
						  },
						  true // make the event "stick"
						);
					  }

					  $('#title').val('');

					  calendar.fullCalendar('unselect');

					  $('.antoclose').click();

					  return false;
					});
				  },
				  eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
					
					  	$.ajax({
							type: "POST",
							url: "<?php echo e(url('adminuser/actualizarEvento')); ?>"+"/"+event.id,
							headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'title='+ event.title+'&start='+ moment(event.start).format("Y-MM-DD HH:mm:ss") +'&end='+ moment(event.end).format("Y-MM-DD HH:mm:ss"),
							success: function(json) {},
							error: function(xhr, status, error) {
							  alert(error+' '+status+' '+xhr);
							  console.log(xhr.responseText);
							}
						});

				  },
				  eventClick: function(calEvent, jsEvent, view) {
					$('#fc_edit').click();
					$('#title2').val(calEvent.title);

					categoryClass = $("#event_type").val();
					$(".antosubmit2").on("click", function() {
					  calEvent.title = $("#title2").val();
					  	$.ajax({
							type: "POST",
							url: "<?php echo e(url('adminuser/actualizarEvento')); ?>"+"/"+calEvent.id,
							headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'title='+ calEvent.title+'&start='+ moment(calEvent.start).format("Y-MM-DD HH:mm:ss") +'&end='+ moment(calEvent.end).format("Y-MM-DD HH:mm:ss"),
							success: function(json) {},
							error: function(xhr, status, error) {
							  alert(error+' '+status+' '+xhr);
							  console.log(xhr.responseText);
							}
						});
					  calendar.fullCalendar('updateEvent', calEvent);
					  $('.antoclose2').click();
					});
					$(".antosubmit3").on("click", function() {
					  calEvent.title = $("#title2").val();
					  	$.ajax({
							type: "POST",
							url: "<?php echo e(url('adminuser/eliminarEvento')); ?>"+"/"+calEvent.id,
							headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							data: 'method=DELETE',
							success: function(json) {calendar.fullCalendar('removeEvents',calEvent.id)},
							error: function(xhr, status, error) {
							  alert(error+' '+status+' '+xhr);
							  console.log(xhr.responseText);
							}
						});
					  $('.antoclose2').click();
					});

					calendar.fullCalendar('unselect');
				  },
				  editable: true,
				  
				});
				
			
		});

    </script>
    <script src="<?php echo e(asset('plugins/monkee-weather')); ?>/jquery.simpleWeather.min.js"></script>
    <script>
    $(document).ready(function() {
      $.simpleWeather({
        location: 'Santiago, CL',
        woeid: '',
        unit: 'c',
        success: function(weather) {
          $(".weather-icon").html('<img src="'+weather.forecast[0].image+'" >');
          $("#textoTiempo").html('<h2>'+weather.city+', '+weather.country+' <br><i>'+weather.text+'</i></h2>');
          $("#temperaturas").html('<strong>Min:</strong> '+weather.low+'°C  <strong>Max:</strong> '+weather.high+'°C');
          $("#titulo").html(weather.title);
        },
        error: function(error) {
          $("#contenido_tiempo").html('<p>'+error+'</p>');
        }
      });
    });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminuser.layout.gentelella', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>