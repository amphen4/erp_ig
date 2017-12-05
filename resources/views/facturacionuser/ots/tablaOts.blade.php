@extends('facturacionuser.layout.gentelella')
@section('title','Ordenes de Trabajo | Facturacion')
@section('css')
<!-- Datatables -->
<link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('templates/gentelella') }}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('contenido')
<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$titulo_tabla}}</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                      @endif
                    <div class="well" style="overflow: auto">
                      <div class="col-md-4 ">
                        Filtrar por Periodo
                        <fieldset>
                          <div class="control-group ">
                            <div class="controls ">
                              <div class="input-prepend input-group ">
                                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                <input type="text" style="width: 200px"   id="filtroFechas" class="form-control"  />
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-md-4 ">
                        Filtrar por Estado
                        <fieldset>
                          <div class="control-group ">
                            <div class="controls ">
                                <select class="form-control" id="filtroCategorias">
                                  <option>Ninguno</option>
                                  <option>PENDIENTE</option>
                                  <option>EN PROCESO</option>
                                  <option>EN COTIZACION</option>
                                  <option>ACTIVA</option>
                                  <option>PERDIDA</option>
                                  <option>POR FACTURAR</option>
                                  <option>FACTURADO</option>
                                  <option>NOTA DE VENTA</option>
                                </select>
                            </div>
                          </div>
                        </fieldset>
                        
                        
                      </div>
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Opciones</th>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                          <th>Comentario</th>
                          <th>Nota de credito</th>
                          <th>Supervisado por:</th>

                          <th>Reportes</th>
                          <th>Fecha entrega</th>
                        </tr>
                      </thead>
                      <tbody id="bodyTabla">
                      	@foreach($filas as $fila)
                        <tr>
                          <td>@if($fila->otestado->nombre == 'POR FACTURAR')<a href="{{ url('/facturacionuser/ots').'/'.$fila->id.'/edit' }}"  class="btn btn-warning btn-xs ">Modificar</a>@endif</td>
                          <td>{{ $fila->id }}</td>
                          <td>{{ $fila->fecha }}</td>
                          <td>{{ $fila->otestado->nombre }}</td>
                          <td>{{ $fila->comentario }}</td>
                          <td>Credito nota</td>
                          <td>@if($fila->adminuser){{$fila->adminuser->name}}@endif</td>
                          
                          <td><a target="_blank" href="{{url('facturacionuser/reporteCotizacion').'/'.$fila->cotizacion->id}}"  class="btn btn-xs"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Cotizacion</a><a target="_blank" href="{{url('facturacionuser/reporteOt').'/'.$fila->id}}" class="btn btn-xs"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> O.T</a></td>
                          <td>{{ $fila->fecha_entrega }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
<div id="results">

</div>
@endsection

@section('js')
<!-- Datatables -->
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/jszip/dist/jszip.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('templates/gentelella') }}/vendors/moment/min/moment.min.js"></script>
<script src="{{ asset('templates/gentelella') }}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
  function aplicarFiltro(){
    
    if($('#filtroFechas').val() == ''){
      var fecha_inicio = null;
      var fecha_fin = null;
    }
    else{
      var fecha_inicio = $('#filtroFechas').data('daterangepicker').startDate.format('YYYY-MM-DD');
      var fecha_fin = $('#filtroFechas').data('daterangepicker').endDate.format('YYYY-MM-DD');
    }
    var estado = $('#filtroCategorias').val();
    console.log('se va a enviar '+fecha_inicio+' y '+fecha_fin+' y ESTADO: '+estado);
    $.ajax({
      type: "POST",
      url: "{{url('facturacionuser/filtrarOts')}}",
      headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: 'estado='+estado+'&inicio='+fecha_inicio+'&fin='+fecha_fin,
      success: function(json) {
        //console.log(json);
        var data = json;
        var wea = $('#datatable-buttons').DataTable();
        wea.clear().draw();
        for(var i=0; i<data['ots'].length; i++){
          console.log(data['ots'][i].id);
          var tiene = '';
          if(data['otestado'][i] == 'POR FACTURAR') tiene = '<a href="'+"{{url('facturacionuser/ots')}}"+'/'+data['ots'][i].id+'/edit" class="btn btn-warning btn-xs">Modificar</a>';
          wea.row.add([tiene,
                      data['ots'][i].id,
                      data['ots'][i].fecha,
                      data['otestado'][i],
                      data['ots'][i].comentario,
                      'Credito Nota',
                      data['adminuser'][i],
                      '<a target="_blank" href="{{url("facturacionuser/reporteCotizacion")}}'+'/'+data['idcotizacion'][i]+'" class="btn btn-xs"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Cotizacion</a><a href="{{url("facturacionuser/reporteOt")}}/'+data['ots'][i].id+'" class="btn btn-xs"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> O.T</a>',
                      data['ots'][i].fecha_entrega]).draw();

        }
      },
      error: function(xhr, status, error) {
        alert('Error en el servidor, porfavor revise los datos que se envian.');
        console.log(xhr.responseText);
      }
    });
  }
  $('#filtroFechas').daterangepicker(
    {
        autoUpdateInput: false,
        locale: {
          format: 'DD-MM-YYYY',
          cancelLabel: 'Borrar',
          applyLabel: 'Aplicar'
        }
    }
  );
  $('#filtroFechas').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
});
  $('#filtroFechas').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
    aplicarFiltro();
  });
  $('#filtroCategorias').change(function(){
    aplicarFiltro();
  });
    
</script>
@endsection