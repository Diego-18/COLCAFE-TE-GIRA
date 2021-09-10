<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiudadesModel extends Model
{
    use HasFactory;
    
    public $table='ciudades';
    public $timestaps=false;

    protected $fillable=[
        'nombre_ciudad',
        'id_depart'
    ];
}
