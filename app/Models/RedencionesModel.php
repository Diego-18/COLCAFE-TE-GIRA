<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedencionesModel extends Model
{
    use HasFactory;


    public $table = 'redenciones';

    public $timestamps = true;

    protected $fillable=['id_usuario','id_producto','gramaje','gramos_registrados'];
}
