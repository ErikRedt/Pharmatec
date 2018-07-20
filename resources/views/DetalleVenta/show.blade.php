@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" align="center">
          <h4>
            Detalle Venta 
          </h4>
        </div>

        <div class="panel-body">

          <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">



          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table hover">
                  <thead>
                    <th>ID</th>
                    <th>ID Venta</th>
                    <th>Medicamento</th>
                    <th>Cantidad</th>
                    <th>Precio Venta</th>
                    <th>subtotal</th>                    
                    <th>Opciones</th>
                  </thead>
  
                  @foreach($dventas as $dven)
                  <tr>
                    <th>{{$dven->iddetalleVenta}}</th>
                    <th>{{$dven->idventa}}</th>
                    <th>{{$dven->nombre}}</th>
                    <th>{{$dven->cantidad}}</th>
                    <th>{{$dven->precio_venta}}</th>                    
                    <th>{{$dven->subtotal}}</th>


                    <th>
                      <a data-target="#modal-delete-{{$dven->iddetalleVenta}}" data-toggle="modal"><button class="btn btn-danger">
                                Eliminar
                      </button></a>
                    </th>
                  </tr>
                  @include('DetalleVenta.modal') 
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