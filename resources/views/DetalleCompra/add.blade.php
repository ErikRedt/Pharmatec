@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" align="center">Nueva compras</div>

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
              @endif {!!Form::open(array('url'=>'DetalleCompra/create','method'=>'POST','autocomplete'=>'off'))!!} {{Form::token()}}


              <div class="panel panel-primary">
                <div class="panel-body">

                  <!--<label>Medicamento</label>
                        <select data-live-search="true" class="form-control">
                          @foreach($medicamentos as $med)
                          <option class="form-control" id="jidarticulo" value="{{$med->idmedicamento}}">{{$med->nombre}} {{$med->descripcion}} {{$med->presentacion}}</option>
                          @endforeach 
                        </select>
                        <label for="cantidad">Cantidad</label>
                      <input type="number" name="cantidad" class="form-control" required >-->


                  <label>Medicamento</label>
                  <select data-live-search="true" class="form-control">
                          @foreach($medicamentos as $med)
                          <option class="form-control" value="{{$med->idmedicamento}}" >{{$med->nombre}} {{$med->descripcion}} {{$med->presentacion}} {{$med->pc}}</option>
                          <input type="hidden" name="precio_compra" value="{{$med->pc}}"></input>
                          @endforeach 
                        </select>
                  <label for="cantidad">Cantidad</label>
                  <input type="number" name="cantidad" class="form-control" required>

                  <div class="form-group">
                    <button class="btn btn-success" type="button" id="bt_add">
                          Agregar
                      </button>

                    <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                    <button class="btn btn-primary" type="submit">
                          Guardar
                      </button>
                    <button class="btn btn-default" type="reset">
                          Reset
                      </button> {!!Form::close()!!}

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @endsection