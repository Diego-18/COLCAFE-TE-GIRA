<?php

use Illuminate\Support\Facades\Route;
use App\Models\TipoDocumentoModel;

Route::get('/', function () {
    return view('home');
})->name("/");



Route::get('/registro/{cc}', function ($cc) {

    $tipo_documento=TipoDocumentoModel::all();
    $cedula = 0;
    if($cc){
        $cedula = $cc;
    }

    return view('registro', compact("cedula","tipo_documento"));
})->where(['id' => '[0-9]+'])->name('registro');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/registro_post', [App\Http\Controllers\LoginController::class, 'validar_registro'])->name('registro_post');
Route::post('/registro_newpost', [App\Http\Controllers\LoginController::class, 'registro'])->name('registro_newpost');
Route::post('/all_departments', [App\Http\Controllers\RegistroEmpaquesController::class, 'all_departments'])->name('all_departments');



//https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json
Route::group(['middleware' => 'session'], function () {
    Route::get('/registro_empaques', [App\Http\Controllers\RegistroEmpaquesController::class, 'index'])->name('registro_empaques');
    Route::post('/registro_post_emp', [App\Http\Controllers\RegistroEmpaquesController::class, 'registro_empa'])->name('registro_empa');
    Route::get('/ver_registro_empa', [App\Http\Controllers\RegistroEmpaquesController::class, 'ver_registro_empa'])->name('ver_registro_empa');
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'signout'])->name('signout');
});

