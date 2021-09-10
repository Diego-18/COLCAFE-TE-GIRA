<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//podria ser autenticable
class UserModel extends Model
{
    use HasFactory, Notifiable;

    public $table = 'usuarios';
    public $timestamps = true;

    protected $filleable=[
        'documento',
        'nombres',
        'apellidos',   
        'email',
        'celular',
        'tel_adic',
        'id_depart',
        'id_ciudad',
        'id_tipo_documento',
        'estado'
    ];
}
