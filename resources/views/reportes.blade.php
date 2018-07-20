@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Reportes</div>

                <div class="panel-body">
                 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <h1>
                          Productos a punto de agotarse
                        </h1>
                        <table  class="table table-striped table-bordered table-condensed table hover">
                          <thead style="text-align:center">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Presentación</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            
                          </thead>
                          @foreach($medicamentos as $med)
                          <tr>
                            <th>{{$med->idmedicamento}}</th>
                            <th>{{$med->nombre}}</th>
                            <th>{{$med->descripcion}}</th>
                            <th>{{$med->presentacion}}</th>
                            <th>{{$med->stock}}</th>
                            <th>
                              <img class="img-thumbnail" width="100px" height="100px" src="{{asset('imagenes/'.$med->imagen)}}" alt="{{$med->nombre}}">             
                              </th>                                                  
                          </tr>                          
                          @endforeach
                        </table>
                      </div>
                      
                      
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
