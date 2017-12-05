@extends('root.layout.gentelella')
@section('title','Csv ql')


@section('contenido')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Waoh </h2>
        
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
        <br />
        <form id="wow" enctype="multipart/form-data"  role="form" method="POST" action="{{ url('/root/csv') }}">
          {{ csrf_field() }}
          
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Archivo:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input  name="file" type="file"   >
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


@endsection