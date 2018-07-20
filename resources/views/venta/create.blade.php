@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Nueva Venta - Salida</div>

                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                      @if (count($errors)>0)
                      <div class="alert alert-danger">
                        <ul>
                          @foreach($errors->all() as $error)
                          <li>{{$error}}</li>
                          @endforeach
                        </ul>
                        
                      </div>
                      @endif
                     {!!Form::open(array('url'=>'venta','method'=>'POST','autocomplete'=>'off'))!!}
                      {{Form::token()}}
                      
                      
                        
                        <br>
                        
                          <div class="panel panel-primary">                     
                            <div class="panel-body">
                              <label>Medicamento</label>
                                    <select id="idmed" name="idmedicamento" class="form-control" onclick="actualizar();">                          
                                      @foreach($medicamentos as $med)
                                      <option  class="form-group" precio="{{$med->pv}}" stock="{{$med->stock}}" value="{{$med->idmedicamento}}" >{{$med->nombre}} {{$med->descripcion}}  {{$med->presentacion}} stock[{{$med->stock}}]</option>
                                      
                                      @endforeach                      
                                       </select>
                                    <br>
                              <div class=" col-md-5 col-sm-6 col-xs-12">
                                 <label for="cantidad">Cantidad</label>                       
                                 <input id="cant" type="number" min="0" max="" size="1" name="cantidad"  required>
                              </div>
                              <div class=" col-md-3 col-sm-6 col-xs-12">
                                <label for="precio">Precio</label>                       
                                 <input id="prec" type="numeric" value="" size="8" name="precio"  required>                                   
                              </div>                               
                                     <button type="button" class="btn btn-primary" id="btadd" onclick="agregar();">
                                        Agregar
                                     </button>                    
                             </div>
                          </div>
                       {!!Form::close()!!}
                      {!!Form::open(array('url'=>'venta','method'=>'POST','autocomplete'=>'off'))!!}
                      <label>Usuario</label>
                        <select name="iduser" class="form-control" id="idus" >
                          @foreach($users as $user)
                          <option class="form-group"  value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach 
                        </select>
                      <br>
                      <div>
                        <table id="detalles" class="table table-condensed table-bordered table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Medicamento</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>subtotal</th>                            
                          </thead>
                          <tfoot>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><h4 id="total">$</h4></th>  
                          </tfoot>
                          <tbody></tbody>
                        </table>
                      </div>
                       <div id="guardar">
                         <input name="_token" value="{{csrf_token()}}" type="hidden"></input>
                         <button class="btn btn-default" type="reset">
                                Reset
                         </button>
                         <button class="btn btn-success" type="submit">
                                Terminar
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
@push('scripts')
<script>
    $(document).ready(function(){
      actualizar();
    $('#btadd').click(function(){
      agregar();
    });
    $('#idmed').click(function(){
      actualizar();
    });  
  });
  
  function actualizar(){
  $("#prec").attr("value",function(){
    var precio = $("#idmed option:selected").attr("precio");
    return precio;
  });
  //$("#cant").attr("value","0");
  //}
  //$("#cant").attr("max",function(){
    //var stock = $("#idmed option:selected").attr("stock");
    //return stock;
  //});
    $("#cant").attr({
  value: 0,
  max: function(){
  var stock = $("#idmed option:selected").attr("stock");
  return stock;
  }
    });
  }

 
  
  var cont=0; 
  total=0; 
  subtotal=[];
  $("#guardar").hide();
  
  function agregar(){
    idmedicamento = $("#idmed").val();
    medicamento = $("#idmed option:selected").text();  
    cantidad = $("#cant").val();
    precio_venta = $("#prec").val();
    
    if(cantidad!=""){
      subtotal[cont]=(cantidad*precio_venta); 
      total = total+subtotal[cont];
      
      var fila = '<tr class="selected" id="fila'+cont+'"><td><button class="btn btn-danger" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idmedicamento[]" value="'+idmedicamento+'">'+medicamento+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="numeric" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
      cont++;
      limpiar();
      $("#total").html("$ " + total);
      evaluar();
      $("#detalles").append(fila);
      }
  }
  
  function limpiar(){
     //$("#idmed").val("");
     $("#cant").val("");
     //$("#prec").val("");
   }
  
  function evaluar(){
    if(total>0){
      $("#guardar").show();
    }
    else{
      $("#guardar").hide();
    }
  }
  function eliminar(index){
    total=total-subtotal[index];
    $("#total").html("$"+total);
    $("#fila"+index).remove();
    evaluar();
  }
</script>
@endpush
@endsection
