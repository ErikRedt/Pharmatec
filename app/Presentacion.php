<?php

namespace Pharmatec;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    //
  protected $table ='presentacion';
  protected $primaryKey = 'idpresentacion';
  public $timestamps = false;//se especifica por que si no los manda unque no* tengamos esos campos en la tabla
  
  protected $fillable = [
   'nombre'//los que el usuario podra enviar
  ];
}
