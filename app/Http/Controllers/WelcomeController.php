<?php

namespace Pharmatec\Http\Controllers;

use Pharmatec\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


use Pharmatec\Http\Controllers\Controller;
use Pharmatec\Medicamento;
use Pharmatec\Http\Requests\MedicamentoFormRequest;
use DB;


class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $query=trim($request->get('searchText'));
      $medicamentos = DB::table('medicamento as m')
        ->join('presentacion as p','m.idpresentacion','=','p.idpresentacion')
        ->select('m.idmedicamento','m.nombre','m.descripcion','p.nombre as presentacion','m.imagen','m.stock','m.precio_compra','m.precio_venta')
        ->where('m.nombre','LIKE','%'.$query.'%')
        ->orderby('m.idmedicamento','asc')->paginate(100);
      return view('welcome',["medicamentos"=>$medicamentos,"searchText"=>$query]);
    }
}
