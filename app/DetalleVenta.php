<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
  protected $table ='detalleVenta';
  protected $primaryKey = 'iddetalleVenta';
  public $timestamps = false ;//se especifica por que si no los manda aunque no* tengamos esos campos en la tabla
  
  protected $fillable = [
    'idventa',//los que el usuario podra enviar
    'idmedicamento',
    'cantidad',
    'subtotal'
  ];
}
