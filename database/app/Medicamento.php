<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    //
  protected $table ='medicamento';
  protected $primaryKey = 'idmedicamento';
  public $timestamps = false;//se especifica por que si no los manda unque no* tengamos esos campos en la tabla
  
  protected $fillable = [//los que el usuario podra enviar
    'idpresentacion',
    'nombre',
    'descripcion',
    'imagen',
    'stock',
    'precio_compra',
    'precio_venta'
    
  ];
}
