<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
  protected $table ='venta';
  protected $primaryKey = 'idventa';
  public $timestamps = false ;//se especifica por que si no los manda unque no* tengamos esos campos en la tabla
  
  protected $fillable = [
    'iduser',//los que el usuario podra enviar
    'total'
  ];
}
