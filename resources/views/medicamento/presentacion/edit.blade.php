@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Editar presentación</div>

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
                     {!!Form::model($presentacion,['method'=>'PATCH','route'=>['medicamento.presentacion.update',$presentacion->idpresentacion]])!!}
                      {{Form::token()}}
                        <p>
                           <input type="text" name="nombre" size="40" value="{{$presentacion->nombre}}"/> 
                           <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
                           <input class="btn btn-primary" type="submit" value="Guardar" />
                           <input class="btn btn-default" type="reset" value="Reset" />
                        </p>
                       
                 
                      {!!Form::close()!!}
                      
                    </div>
                    
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection