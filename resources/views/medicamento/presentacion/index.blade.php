@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">  <h4>
                        Listado de Presentaciones
                      </h4></div>

                <div class="panel-body">
                  
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    
                      @include('medicamento/presentacion/search')
                          <a href="presentacion/create"><button style="margin-bottom:1em" class="btn btn-success">+</button></a>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table hover">
                          <thead><th>ID</th><th>Nombre</th><th>Opciones</th></thead>
                          @foreach($presentaciones as $pres)
                          <tr>
                            <th>{{$pres->idpresentacion}}</th>
                            <th>{{$pres->nombre}}</th>
                            <th>
                              <a href="{{URL::action('PresentacionController@edit',$pres->idpresentacion)}}"><button class="btn btn-info">
                                Editar
                                </button></a>
                              <a data-target="#modal-delete-{{$pres->idpresentacion}}" data-toggle="modal"><button class="btn btn-danger">
                                Eliminar
                                </button></a>
                            </th>
                          </tr>
                          @include('medicamento.presentacion.modal')
                          @endforeach
                        </table>
                      </div>
                      {{$presentaciones->render()}}
                      
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
