<?php

namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Pharmatec\Http\Requests;
use Pharmatec\Http\Controllers\Controller;
use Pharmatec\Presentacion;
use Pharmatec\Http\Requests\PresentacionFormRequest;
use DB;



class PresentacionController extends Controller
{
    //
  
  public function __construct(){
    $this->middleware('auth');
    
  }
public function index(Request $request){
    if($request){
      $query=trim($request->get('searchText'));
      $presentaciones = DB::table('presentacion')->where('nombre','LIKE','%'.$query.'%')
        ->orderby('idpresentacion','asc')->paginate(5);
      return view('medicamento.presentacion.index',["presentaciones"=>$presentaciones,"searchText"=>$query]);
    }
    

    
  }
  public function create(){
    return view("medicamento.presentacion.create");
    
  }
  public function show($id){
  return view("medicamento.presentacion.show",["presentacion"=>Presentacion::findOrFail($id)]);
  }
  
  public function store(PresentacionFormRequest $request){
    $presentacion = new Presentacion;
    $presentacion->nombre=$request->get('nombre');
    $presentacion->save();
    return Redirect::to('medicamento/presentacion');
    
  }
  public function edit($id){
    return view("medicamento.presentacion.edit",["presentacion"=>Presentacion::findOrFail($id)]);
  }
  public function update(PresentacionFormRequest $request,$id){
    $presentacion=Presentacion::findOrFail($id);
    $presentacion->nombre=$request->get('nombre');
    $presentacion->update();
    return Redirect::to('medicamento/presentacion');

  }

  public function destroy($id){
    Presentacion::destroy($id);
   return Redirect::to('medicamento/presentacion');
  }
}
