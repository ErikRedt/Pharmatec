<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$dcom->iddetalleCompra}}">
  {{Form::open(array('action'=>array('DetalleCompraController@destroy',$dcom->iddetalleCompra),'method'=>'get'))}}

      <div class="panel panel-danger" style="margin-top:20%; width:25em; margin-left:auto; margin-right:auto;">
      <div class="panel-heading">Estas seguro?</div>
      <div class="panel-body">
        
  <button type="button" class="btn btn-default" data-dismiss="modal">
      Cancelar  
  </button>
  <button type="submit" class="btn btn-primary">
      Eliminar
  </button>
        </div>
    </div>




  {{Form::close()}}
  
  
</div>