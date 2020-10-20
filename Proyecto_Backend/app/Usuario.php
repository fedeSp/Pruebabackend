<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    #no hace falta especificar los atributos ya que los toma de la bd
    
    public $primaryKey = "id";
    public $timestamps = false;
    public $guarded = [];
}
