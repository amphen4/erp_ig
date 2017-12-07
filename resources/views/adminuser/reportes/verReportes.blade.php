@extends('adminuser.layout.gentelella')
@section('title','Reportes | Administrador')
@section('contenido')
<div class="row">
			<div class="col-md-6">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Historial de Reportes <small>ID: {{$ot->id}}</small></h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <ul class="list-unstyled msg_list">
                  	@foreach($ot->reporte as $reporte)
                    <li>
                      <a>
                        <span class="image">
                          <span class="glyphicon glyphicon-save-file" aria-hidden="true" ></span>
                        </span>
                        <span>
                          <span>{{$reporte->filename}}</span>
                          
                          <span class="time">{{$reporte->fecha->diffForHumans()}}</span>

                        </span>
                        
                        <span class="message"><h4>Comentario:</h4>
                        	{{$reporte->comentario}}
                        </span>
                        <hr>
                        <span class="message">
                        <button value="{{$reporte->id}}" class="btn btn-danger btn-xs">Eliminar</button>
                        <button value="{{$reporte->filename}}" class="btn btn-primary btn-xs">Descargar</button>
                    	</span>
                      </a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
</div>
@endsection
@section('js')
<script>
	$('.btn-danger').click(function(){
		if(confirm('Esta seguro ?')){
			$.ajax({
		        type: "POST",
		        url: "{{url('adminuser/reportes')}}"+'/{{$ot->id}}',
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
		window.open('{{url('adminuser')}}'+'/descargarReporte/'+$(this).val(),'_blank');
	})
</script>
@endsection