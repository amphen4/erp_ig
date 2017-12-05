@extends('ventasuser.layout.gentelella')

@section('title','Cotizaciones | Ventas')

@section('css')
<!-- Datatables -->
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                    <p class="text-muted font-13 m-b-30">
                      {{$descripcion_tabla}}
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
                          <th>Reporte</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($filas as $fila)
                        <tr>
                          @if($fila->cliente)
                            <td>{{ $fila->cliente->razon_social }}</td>
                          @else
                            <td>Cliente Eliminado</td>
                          @endif
                          <td> <button value="{{$fila->id}}" type="button" class="btn btn-primary btn-xs botonDetalle" data-toggle="modal" data-target=".bs-example-modal-lg">Ver Detalle</button></td>
                          <td>{{ '$'.number_format($fila->valor_neto,0,",",".") }}</td>
                          @if($fila->descuento > 0)
                          <td>{{ $fila->descuento.'%' }}</td>
                          @else
                          <td>-</td>
                          @endif
                          <td><strong>{{ '$'.number_format($fila->valor_total,0,",",".") }}</strong></td>
                          <td>{{ $fila->ventasuser->name }}</td>
                          @if($fila->ot)
                            @if($fila->ot->otestado->nombre == 'PENDIENTE')
                            <td>{{ $fila->ot->otestado->nombre }}  <a href="{{ url('/ventasuser/cotizaciones').'/'.$fila->id.'/edit' }}"  class="btn btn-warning btn-xs ">Editar</a></td>
                            @else
                            <td>{{ $fila->ot->otestado->nombre }}</td>
                            @endif
                            <td>{{ $fila->ot->id }}</td>
                          @else
                            <td></td>
                            <td></td>
                          @endif
                          <td><a target="_blank" href="{{url('ventasuser/reporteCotizacion').'/'.$fila->id}}"  class="btn btn-xs"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> Cotizacion</a></td>
                        </tr>
                        @endforeach
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
<script>
  $('.botonDetalle').on('click', function (e) {
    $.ajax({
      type: "GET",
      url: "{{url('ventasuser/cotizacion')}}"+"/"+$(this).val(),
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
@endsection