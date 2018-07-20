<?php
namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

use Pharmatec\Http\Controllers\Controller;
use Pharmatec\Compra;
use Pharmatec\DetalleCompra;
use Pharmatec\Http\Requests\CompraFormRequest;

use DB;
use Response;



class CompraController extends Controller
{
    //
  public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function index(request $request){
      if($request){
      $query=trim($request->get('searchText'));
      $compras = DB::table('compra as c')
        ->join('users as u','c.iduser','=','u.id')
        ->leftjoin('detalleCompra as dc','c.idcompra','=','dc.idcompra')
        ->select('c.idcompra','u.name as usuario','c.fecha',DB::raw('sum(dc.subtotal) as total'))
        ->where('u.name','LIKE','%'.$query.'%')
        ->orderby('c.idcompra','desc')
        ->groupby('c.idcompra')
        ->paginate(7);
      return view('compra.index',["compras"=>$compras,"searchText"=>$query]);
  }
}

  public function create(){
    $users=DB::table('users')->get();
    $medicamentos=DB::table('medicamento as m')
      ->join('presentacion as p','m.idpresentacion','=','p.idpresentacion')
      ->select('m.idmedicamento','m.nombre','p.idpresentacion','p.nombre as presentacion','m.descripcion','m.precio_compra as pc','m.stock')
      ->get();
    $detalleCompra=DB::table('detalleCompra')->get();
    return view("compra.create",["medicamentos"=>$medicamentos,"users"=>$users]);
    
  }



  public function store(CompraFormRequest $request){


    $compra = new Compra;
    $compra->iduser = $request->get('iduser');
    $compra->save();
/* 
    $detalleCompra = new DetalleCompra;
    $detalleCompra->idcompra = $compra->idcompra;
    $detalleCompra->idmedicamento = $request->get('idmedicamento');
    $detalleCompra->cantidad = $request->get('cantidad');
    $detalleCompra->subtotal = $detalleCompra->cantidad*$request->get('precio');
    $detalleCompra->save();
*/ 
    $idcompra = $compra->idcompra;
    $idmed = $request->get('idmedicamento');
    $cantidad = $request->get('cantidad');
    $precio = $request->get('precio_compra');
    
    $cont = 0;
    
    while($cont < count($idmed)){
     
    $detalleCompra = new DetalleCompra;
    $detalleCompra->idcompra = $idcompra;
    $detalleCompra->idmedicamento = $idmed[$cont];
    $detalleCompra->cantidad = $cantidad[$cont];
    $detalleCompra->subtotal = $cantidad[$cont]*$precio[$cont];
    $detalleCompra->save();
    $cont++;
    }
    
    
    return Redirect::to('compra');
  }

  



  public function destroy($id){
    $detalleCompra = DetalleCompra::where('idcompra','=',$id);
    $detalleCompra->delete();
    Compra::destroy($id);
   return Redirect::to('compra');
  }
  
}

