@extends('layouts.app') @section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" align="center">
          <h4>
            Detalle Compra 
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
                    <th>ID Compra</th>
                    <th>Medicamento</th>
                    <th>Cantidad</th>
                    <th>Precio compra</th>
                    <th>subtotal</th>                    
                    <th>Opciones</th>
                  </thead>
                  @if($dcompras)
  
                  @foreach($dcompras as $dcom)
                  <tr>
                    <th>{{$dcom->iddetalleCompra}}</th>
                    <th>{{$dcom->idcompra}}</th>
                    <th>{{$dcom->nombre}}</th>
                    <th>{{$dcom->cantidad}}</th>
                    <th>{{$dcom->precio_compra}}</th>                    
                    <th>{{$dcom->subtotal}}</th>


                    <th>
                      <a data-target="#modal-delete-{{$dcom->iddetalleCompra}}" data-toggle="modal"><button class="btn btn-danger">
                                Eliminar
                                </button></a>
                    </th>
                  </tr>
                  @include('DetalleCompra.modal') 
                  @endforeach                  
                  
                  @endif
                  </button></a>                  
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