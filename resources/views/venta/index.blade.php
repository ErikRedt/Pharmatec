@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">  <h4>
                        Listado de Ventas
                      </h4></div>

                <div class="panel-body">
                  
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                    
                      @include('venta/search')
                          <a href="venta/create"><button style="margin-bottom:1em" class="btn btn-success">+</button></a>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table hover">
                          <thead><th>ID</th><th>Usuario</th><th>Total</th><th>Fecha</th><th>Opciones</th></thead>
                          @foreach($ventas as $ven)
                          <tr>
                            <th>{{$ven->idventa}}</th>
                            <th>{{$ven->usuario}}</th>
                            <th>{{$ven->total}}</th>
                            <th>{{$ven->fecha}}</th>
                            
                            <th>
                              <a href="{{URL::action('DetalleVentaController@show',$ven->idventa)}}"><button class="btn btn-primary">
                                Detalles 
                                </button></a>
                             
                              <a data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">
                                Eliminar
                                </button></a>
                            </th>
                          </tr>
                          @include('venta.modal')
                          @endforeach
                        </table>
                      </div>
                      {{$ventas->render()}}
                      
                    </div>
                  </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
