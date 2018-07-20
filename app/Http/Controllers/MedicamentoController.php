<?php

namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Pharmatec\Http\Requests;
use Pharmatec\Http\Controllers\Controller;
use Pharmatec\Medicamento;
use Pharmatec\Http\Requests\MedicamentoFormRequest;
use DB;

class MedicamentoController extends Controller
{
    //
  public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function index(Request $request){
    if($request){
      $query=trim($request->get('searchText'));
      $medicamentos = DB::table('medicamento as m')
        ->join('presentacion as p','m.idpresentacion','=','p.idpresentacion')
        ->select('m.idmedicamento','m.nombre','m.descripcion','p.nombre as presentacion','m.imagen','m.stock','m.precio_compra','m.precio_venta')
        ->where('m.nombre','LIKE','%'.$query.'%')
        ->orderby('m.idmedicamento','asc')->paginate(5);
      return view('medicamento.index',["medicamentos"=>$medicamentos,"searchText"=>$query]);
    }
    

    
  }
  public function create(){
    $presentaciones=DB::table('presentacion')->get();
    return view("medicamento.create",["presentaciones"=>$presentaciones]);
    
  }

  public function store(MedicamentoFormRequest $request){
      ini_set('post_max_size','50M');
      ini_set('upload_max_filesize','50M');
      ini_set('max_execution_time','1000');
      ini_set('max_input_time','1000');
    $medicamento = new Medicamento;
    $medicamento->idpresentacion=$request->get('idpresentacion');
    $medicamento->nombre=$request->get('nombre');
    $medicamento->descripcion=$request->get('descripcion');
    $medicamento->stock=$request->get('stock');
    $medicamento->precio_venta=$request->get('precio_venta');
    $medicamento->precio_compra=$request->get('precio_compra');
    
    if(Input::hasFile('imagen')){
      $file=Input::file('imagen');
      $file->move(public_path().'/imagenes',$file->getClientOriginalName());
      $medicamento->imagen=$file->getClientOriginalName();
    }
    $medicamento->save();
    return Redirect::to('medicamento');
    
  }
  public function show($id){
  return view("medicamento.show",["medicamento"=>Medicamento::findOrFail($id)]);
  } 
  
  public function edit($id){
    $medicamento = Medicamento::findOrFail($id);
    $presentaciones = DB::table('presentacion')->get();
    return view("medicamento.edit",["medicamento"=>$medicamento,"presentaciones"=>$presentaciones]);
  }
  public function update(MedicamentoFormRequest $request,$id){
    $medicamento=Medicamento::findOrFail($id);
    $medicamento->idpresentacion=$request->get('idpresentacion');
    $medicamento->nombre=$request->get('nombre');
    $medicamento->descripcion=$request->get('descripcion');
    $medicamento->stock=$request->get('stock');
    $medicamento->precio_venta=$request->get('precio_venta');
    $medicamento->precio_compra=$request->get('precio_compra');
    
    if(Input::hasFile('imagen')){
      $file=Input::file('imagen');
      $file->move(public_path().'/imagenes',$file->getClientOriginalName());
      $medicamento->imagen=$file->getClientOriginalName();
    }
    $medicamento->update();
    return Redirect::to('medicamento');

  }

  public function destroy($id){
    Medicamento::destroy($id);
   return Redirect::to('medicamento');
  }
  
}
