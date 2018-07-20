<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //
  protected $table ='compra';
  protected $primaryKey = 'idcompra';
  public $timestamps = false ;//se especifica por que si no los manda unque no* tengamos esos campos en la tabla
  
  protected $fillable = [
    'iduser',//los que el usuario podra enviar
    'total'
  ];
}
