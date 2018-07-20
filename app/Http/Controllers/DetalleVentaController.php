<?php

namespace Pharmatec\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
//use Pharmatec\Http\Requests;

//use Illuminate\Http\Request;


use Pharmatec\Http\Controllers\Controller;
use Pharmatec\DetalleVenta;
use DB;
use Response;
use Pharmatec\Http\Requests\DetalleVentaFormRequest;




class DetalleVentaController extends Controller
{
    //
  public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function show($id){
      $dventas = DB::table('detalleVenta as dv')
        ->join('medicamento as m','dv.idmedicamento','=','m.idmedicamento')
        ->select('dv.iddetalleVenta','dv.idventa','m.nombre','dv.cantidad','m.precio_venta','dv.subtotal')
        ->where('dv.idventa','=',$id)
        ->orderby('dv.iddetalleVenta')
        ->paginate(7);
      return view('DetalleVenta.show',["dventas"=>$dventas]);
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
    DetalleVenta::destroy($id);
   return Redirect::to('venta');
  }
}
