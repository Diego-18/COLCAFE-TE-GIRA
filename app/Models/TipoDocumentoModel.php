<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentoModel extends Model
{
    use HasFactory;

    public $table = 'tipo_documento';
    public $timestamps = false;

    protected $filleable=[
        'nombre_documento',
    ];
}
