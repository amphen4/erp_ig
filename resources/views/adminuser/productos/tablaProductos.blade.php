@extends('adminuser.layout.gentelella')

@section('title','Productos')

@section('css')
<!-- Datatables -->
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('templates/gentelella') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection

@section('contenido')
<!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cubes"></i> Total Productos</span>
              <div class="count">{{$total_productos}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cube"></i> Prod. Mayor Stock</span>
              <div class="count">{{$producto_mayor_stock->stock}}</div>
              <span class="count_bottom"> {{$producto_mayor_stock->nombre}}</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cube"></i> Cantidad P. Sin Stock</span>
              <div @if($productos_sin_stock == 0) class="count green" @else class="count red" @endif>{{$productos_sin_stock}}</div>
            </div>
          </div>
          <!-- /top tiles -->
<div class="row">
			  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$titulo_tabla}}</h2>
                    <button id="botonAgregar" class="btn btn-primary navbar-right" >Agregar nuevo producto</button>
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
                          <th>Nombre Producto</th>
                          <th>Marca</th>
                          <th>Categoria</th>
                          <th>Inventario</th>
                          <th>Codigo Barras</th>
                          <th>Stock</th>
                          <th>Costo Neto</th>
                          <th>Monto IVA</th>
                          <th>Precio Venta</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($filas as $fila)
                        <tr>
                          <td><a href="{{ url('/adminuser/productos').'/'.$fila->id.'/edit' }}"  class="btn btn-warning btn-xs ">Editar</a><button   class="btn btn-danger btn-xs " value="{{$fila->id}}" >Eliminar</button></td>
                          <td>{{ $fila->id }}</td>
                          <td>{{ str_limit($fila->nombre,20) }}</td>
                          <td>{{ str_limit($fila->marca->nombre,20) }}</td>
                          <td>{{ str_limit($fila->categoria->nombre,20) }}</td>
                          <td>{{ str_limit($fila->inventario->nombre,20) }}</td>
                          <td>{{ $fila->codigo }}</td>
                          <td>{{ $fila->stock }}</td>
                          <td><strong>{{ '$'.number_format($fila->precio_neto,0,",",".") }}</strong></td>
                          <td><strong>{{ '$'.number_format($fila->precio_iva,0,",",".") }}</strong></td>
                          <td><strong>{{ '$'.number_format($fila->precio_venta,0,",",".") }}</strong></td>
                          
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
      <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/adminuser/productos') }}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Nuevo Producto</h4>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
            <label  class="col-md-4 control-label">Nombre producto:</label>

            <div class="col-md-6">
                <input  type="text" required="required" class="form-control" name="nombre"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Stock:</label>

            <div class="col-md-6">
                <input  type="number" min="0" required="required" class="form-control" name="stock"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Codigo Interno:</label>

            <div class="col-md-6">
                <input  type="number"  required="required" class="form-control" name="codigo_interno"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Marca:</label>

            <div class="col-md-6">
                <select name="marca">
                  @foreach($marcas as $marca)
                  <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Categoria:</label>

            <div class="col-md-6">
                <select name="categoria">
                  @foreach($categorias as $categoria)
                  <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Inventario:</label>

            <div class="col-md-6">
                <select name="inventario">
                  @foreach($inventarios as $inventario)
                  <option value="{{$inventario->id}}">{{$inventario->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Costo Neto:</label>

            <div class="col-md-6">
                <input  type="number" min="0" required="required" class="form-control" name="precio_neto"  >
            </div>
        </div>
        <div class="form-group">
            <label  class="col-md-4 control-label">Precio Venta:</label>

            <div class="col-md-6">
                <input  type="number" min="0" required="required" class="form-control" name="precio_venta"  >
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
<form id="formEliminar" method="POST" action="{{url('/adminuser/productos/')}}" enctype="multipart/form-data">
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
      if(confirm('Esta seguro?'))
      {
        $('#formEliminar').attr('action',"{{url('/adminuser/productos/')}}"+'/'+$(this).val());
        $('#formEliminar').submit();
      }  
    });
    


</script>

@endsection