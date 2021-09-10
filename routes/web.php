<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("/");



Route::get('/registro/{cc}', function ($cc) {
    $cedula = 0;
    if($cc){
        $cedula = $cc;
    }
    return view('registro', compact("cedula"));
})->where(['id' => '[0-9]+'])->name('registro');

Route::get('/terminos', function () {
    return view('terminos');
})->name("terminos");

Route::get('/ganadores', function () {
    return view('ganadores');
})->name("ganadores");

Route::get('/puntos', function () {
    return view('puntos');
})->name("puntos");

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/registro_post', [App\Http\Controllers\LoginController::class, 'validar_registro'])->name('registro_post');
Route::post('/registro_newpost', [App\Http\Controllers\LoginController::class, 'registro'])->name('registro_newpost');


Route::group(['middleware' => 'session'], function () {
    Route::get('/registro_empaques', [App\Http\Controllers\RegistroEmpaquesController::class, 'index'])->name('registro_empaques');
});