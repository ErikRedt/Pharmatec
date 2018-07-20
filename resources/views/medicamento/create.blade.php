@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" align="center">Agregar Medicamento</div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              @if (count($errors)>0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>

              </div>
              @endif 
              {!!Form::open(array('url'=>'medicamento','method'=>'POST','autocomplete'=>'off', 'files'=>'true'))!!} 
              {{Form::token()}}
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" required placeholder="{{old('nombre')}}">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" class="form-control" required placeholder="{{old('descripcion')}}">
              </div>
              <div class="form-group">
                <p>
                  <label>Presentación</label>
                </p>
                <select name="idpresentacion" class="form-group">
                          @foreach($presentaciones as $pres)
                          <option value="{{$pres->idpresentacion}}">{{$pres->nombre}}</option>
                          @endforeach
                        </select>
              </div>
              <div class="form-group">
                <label for="stock">Stock</label>
                <input type="text" name="stock" class="form-control" required placeholder="{{old('stock')}}">
              </div>
              <div class="form-group">
                <label for="precio_compra">Precio compra</label>
                <input type="text" name="precio_compra" class="form-control" required placeholder="{{old('precio_compra')}}">
              </div>
              <div class="form-group">
                <label for="precio_venta">Precio venta</label>
                <input type="text" name="precio_venta" class="form-control" required placeholder="{{old('precio_venta')}}">
              </div>
              <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" >
              </div>              


              <div class="form-group">
                <button class="btn btn-primary" type="submit">
                          Guardar
                      </button>
                <button class="btn btn-default" type="reset">
                          Reset
                      </button>
              </div>
              {!!Form::close()!!}

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection