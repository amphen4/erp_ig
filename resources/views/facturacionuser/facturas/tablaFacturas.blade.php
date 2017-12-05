@extends('facturacionuser.layout.gentelella')
@section('title','Facturas | Facturacion')
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
                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Cliente</th>
                          <th>RUT</th>
                          <th>Total</th>
                          <th>IVA</th>
                          <th>Neto</th>
                          <th>Modo Pago</th>
                        </tr>
                      </thead>
                      <tbody id="bodyTabla">
                      	@foreach($filas as $fila)
                        <tr>
                          <td>{{ $fila->id }}</td>
                          <td>{{ $fila->fecha }}</td>
                          <td>{{ $fila->cliente }}</td>
                          <td>{{ $fila->rut }}</td>
                          <td>{{ number_format($fila->total,0,",",".") }}</td>
                          <td>{{ number_format($fila->iva,0,",",".") }}</td>
                          <td>{{ number_format($fila->neto,0,",",".") }}</td>
                          <td>{{ $fila->ot->medio_pago }}</td>
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
    
    console.log('se va a enviar '+fecha_inicio+' y '+fecha_fin);
    $.ajax({
      type: "POST",
      url: "{{url('facturacionuser/filtrarFacturas')}}",
      headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: 'inicio='+fecha_inicio+'&fin='+fecha_fin,
      success: function(json) {
        //console.log(json);
        var data = json;
        var wea = $('#datatable-buttons').DataTable();
        wea.clear().draw();
        for(var i=0; i<data['facturas'].length; i++){
          console.log(data['facturas'][i].id);
          
          wea.row.add([
                      data['facturas'][i].id,
                      data['facturas'][i].fecha,
                      data['facturas'][i].cliente,
                      data['facturas'][i].rut,
                      data['facturas'][i].total.toLocaleString(),
                      data['facturas'][i].iva.toLocaleString(),
                      data['facturas'][i].neto.toLocaleString(),
                      data['medio_pago'][i]
                      ]).draw();
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
        },
        ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Este Mes': [moment().startOf('month'), moment().endOf('month')],
           'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
  
    
</script>
@endsection