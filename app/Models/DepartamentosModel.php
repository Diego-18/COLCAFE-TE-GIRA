<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentosModel extends Model
{
    use HasFactory;

    public $table = 'departamentos';

    public $timestaps= false;

    protected $fillable=['nombre_depart',];
}
