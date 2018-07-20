@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Agregar Presentación</div>

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
                     {!!Form::open(array('url'=>'medicamento/presentacion','method'=>'POST','autocomplete'=>'off'))!!}
                      {{Form::token()}}
                      <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre...">
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                          Guardar
                      </button>
                      <button class="btn btn-default" type="reset">
                          Reset
                      </button>
                      </div>
                      {!!Form::close()!!}
                      <!--
                      <form action="{{ url('/medicamento/presentacion/store') }}" method="POST" autocomplete="off" >
                        <p>
                           <input type="text" name="nombre" size="40" placeholder="Nombre..." /> 
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input class="btn btn-primary" type="submit" value="Guardar" />
                           <input class="btn btn-default" type="reset" value="Reset" />
                        </p>
                       
                      
                      </form>  
                      -->
                    </div>
                    
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
