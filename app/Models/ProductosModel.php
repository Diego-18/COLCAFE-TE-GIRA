<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    use HasFactory;

    public $table = 'producto';

    public $timestamps = true;

    protected $fillable=['id','producto'];
}
