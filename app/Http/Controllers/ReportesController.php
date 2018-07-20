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

class ReportesController extends Controller
{
    //
   public function __construct(){//para el inicio de sesion
    $this->middleware('auth');
    
  }
    public function index(){

      $medicamentos = DB::table('medicamento as m')
        ->join('presentacion as p','m.idpresentacion','=','p.idpresentacion')
        ->select('m.idmedicamento','m.nombre','m.descripcion','p.nombre as presentacion','m.imagen','m.stock')
        ->where('m.stock','<','10')
        ->orderby('stock','asc')->paginate(100);
      return view('reportes',["medicamentos"=>$medicamentos]);
    }
    

    
  }

