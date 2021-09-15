<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gramajeModel extends Model
{
    use HasFactory;

    
    public $table = 'gramaje';

    public $timestamps = true;

    protected $fillable=['id','gramaje','id_producto'];
}
