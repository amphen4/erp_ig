@extends('adminuser.layout.gentelella')

@section('title','Inventarios')

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
                    <button id="botonAgregar" class="btn btn-primary navbar-right" >Agregar nuevo inventario</button>
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
                          <th>Opciones</th>
                          <th>ID</th>
                          <th>Nombre Inventario</th>
                          <th>Sucursal</th>
                          <th>Direccion Sucursal</th>
                          <th>Cantidad de Productos</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($filas as $fila)
                        <tr>
                          <td><a href="{{ url('/adminuser/inventarios').'/'.$fila->id.'/edit' }}"  class="btn btn-warning btn-xs ">Editar</a><!--<button   class="btn btn-danger btn-xs " value="{{$fila->id}}" >Eliminar</button>--></td>
                          <td>{{ $fila->id }}</td>
                          <td>{{ $fila->nombre }}</td>
                          <td>{{ $fila->sucursal->nombre }}</td>
                          <td>{{ $fila->sucursal->direccion }}</td>
                          <td>{{ $fila->producto->count() }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
</div>
<!-- Ventana Modal bootstrap -->
<div  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/adminuser/inventarios') }}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nuevo Inventario</h4>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
            <label  class="col-md-4 control-label">Nombre:</label>

            <div class="col-md-6">
                <input  type="text" required="required" class="form-control" name="nombre"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Sucursal:</label>

            <div class="col-md-6">
                <select name="sucursal">
                  @foreach($sucursales as $sucursal)
                  <option value="{{$sucursal->id}}">{{$sucursal->nombre.' - '.$sucursal->direccion}}</option>
                  @endforeach
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit"  class="btn btn-success" id="btnGUARDAR">Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<form id="formEliminar" method="POST" action="{{url('/adminuser/inventarios/')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}
</form>
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

    $("#botonAgregar").click(function(){
        $(".bs-example-modal-lg").modal("show");
        
    });
    $(".btn-danger").click(function(){
      if(confirm('Esta seguro?. Se eliminarían todos los productos asociados.'))
      {
        $('#formEliminar').attr('action',"{{url('/adminuser/inventarios/')}}"+'/'+$(this).val());
        $('#formEliminar').submit();
      }  
    });
    


</script>

@endsection