<?php
namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

use Pharmatec\Http\Controllers\Controller;
use Pharmatec\Venta;
use Pharmatec\DetalleVenta;
use Pharmatec\Http\Requests\VentaFormRequest;

use DB;
use Response;



class VentaController extends Controller
{
    //
  public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function index(request $request){
      if($request){
      $query=trim($request->get('searchText'));
      $ventas = DB::table('venta as v')
        ->join('users as u','v.iduser','=','u.id')
        ->leftjoin('detalleVenta as dv','v.idventa','=','dv.idventa')
        ->select('v.idventa','u.name as usuario','v.fecha',DB::raw('sum(dv.subtotal) as total'))
        ->where('u.name','LIKE','%'.$query.'%')
        ->orderby('v.idventa','desc')
        ->groupby('v.idventa')
        ->paginate(7);
      return view('venta.index',["ventas"=>$ventas,"searchText"=>$query]);
  }
}

  public function create(){
    $users=DB::table('users')->get();
    $medicamentos=DB::table('medicamento as m')
      ->join('presentacion as p','m.idpresentacion','=','p.idpresentacion')
      ->select('m.idmedicamento','m.nombre','p.idpresentacion','p.nombre as presentacion','m.descripcion','m.precio_venta as pv','m.stock')
      ->get();
    //$detalleVenta=DB::table('detalleVenta')->get();
    return view("venta.create",["medicamentos"=>$medicamentos,"users"=>$users]);
    
  }



  public function store(VentaFormRequest $request){


    $venta = new Venta;
    $venta->iduser = $request->get('iduser');
    $venta->save();

    $idventa = $venta->idventa;
    $idmed = $request->get('idmedicamento');
    $cantidad = $request->get('cantidad');
    $precio = $request->get('precio_venta');
    
    $cont = 0;
    
    while($cont < count($idmed)){
     
    $detalleVenta = new DetalleVenta;
    $detalleVenta->idventa = $idventa;
    $detalleVenta->idmedicamento = $idmed[$cont];
    $detalleVenta->cantidad = $cantidad[$cont];
    $detalleVenta->subtotal = $cantidad[$cont]*$precio[$cont];
    $detalleVenta->save();
    $cont++;
    }
    
    
    return Redirect::to('venta');
  }

  



  public function destroy($id){
    $detalleVenta = DetalleVenta::where('idventa','=',$id);
    $detalleVenta->delete();
    Venta::destroy($id);
   return Redirect::to('venta');
  }
  
}

