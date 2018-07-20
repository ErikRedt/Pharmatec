<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    //
  protected $table ='detalleCompra';
  protected $primaryKey = 'iddetalleCompra';
  public $timestamps = false ;//se especifica por que si no los manda aunque no* tengamos esos campos en la tabla
  
  protected $fillable = [
   'idcompra',//los que el usuario podra enviar
    'idmedicamento',
    'cantidad',
    'subtotal'
  ];
}
