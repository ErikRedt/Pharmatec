<?php
namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

use Pharmatec\Http\Controllers\Controller;
use Pharmatec\DetalleCompra;
//use Pharmatec\Http\Requests\DetalleCompraFormRequest;

use DB;
use Response;



class DetalleCompraController extends Controller
{
    //
  public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function show($id){
      $dcompras = DB::table('detalleCompra as dc')
        ->join('medicamento as m','dc.idmedicamento','=','m.idmedicamento')
        ->select('dc.iddetalleCompra','dc.idcompra','m.nombre','dc.cantidad','m.precio_compra','dc.subtotal')
        ->where('dc.idcompra','=',$id)
        ->orderby('dc.iddetalleCompra')
        ->paginate(7);
      return view('DetalleCompra.show',["dcompras"=>$dcompras]);
  }


  public function store(CompraFormRequest $request){


    $compra = new Compra;
    $compra->iduser = $request->get('iduser');
    $compra->save();
    
    $id=$compra->idcompra;
    
    $medicamentos = DB::table('medicamentos');
    
    return view('DetalleCompra.add'.["id"=>$id,"medicamentos"=>$medicamentos]);
  }

  



  public function destroy($id){
    DetalleCompra::destroy($id);
   return Redirect::to('compra');
  }
  
}
