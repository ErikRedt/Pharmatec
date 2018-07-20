@extends('layouts.app')

@section('content')
<style>
  th{
    text-align:center;
  }
</style>
  


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">  <h4>
                        Listado de Medicamentos
                      </h4></div>
  
                <div class="panel-body">
                  
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    
                      @include('medicamento/search')
                          <a href="medicamento/create"><button style="margin-bottom:1em" class="btn btn-success">+</button></a>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <table  class="table table-striped table-bordered table-condensed table hover">
                          <thead style="text-align:center">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Presentación</th>
                            <th>Stock</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Imagen</th>
                            <th>Opciones</th>
                          </thead>
                          @foreach($medicamentos as $med)
                          <tr>
                            <th>{{$med->idmedicamento}}</th>
                            <th>{{$med->nombre}}</th>
                            <th>{{$med->descripcion}}</th>
                            <th>{{$med->presentacion}}</th>
                            <th>{{$med->stock}}</th>
                            <th>{{$med->precio_compra}}</th>
                            <th>{{$med->precio_venta}}</th>
                            <th>
                              <img class="img-thumbnail" width="100px" height="100px" src="{{asset('imagenes/'.$med->imagen)}}" alt="{{$med->nombre}}">             
                              </th>                       
                            <th>
                              <a href="{{URL::action('MedicamentoController@edit',$med->idmedicamento)}}"><button class="btn btn-info">
                                Editar
                                </button></a>
                              <a data-target="#modal-delete-{{$med->idmedicamento}}" data-toggle="modal"><button class="btn btn-danger">
                                Eliminar
                                </button></a>
                            </th>
                          </tr>
                          @include('medicamento.modal')
                          @endforeach
                        </table>
                      </div>
                      {{$medicamentos->render()}}
                      
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
