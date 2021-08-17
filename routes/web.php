<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("/");

Route::get('/registro', function () {
    return view('registro');
})->name("registro");

Route::get('/mecanica', function () {
    return view('mecanica');
})->name("mecanica");

Route::get('/terminos', function () {
    return view('terminos');
})->name("terminos");

Route::get('/ganadores', function () {
    return view('ganadores');
})->name("ganadores");

Route::get('/puntos', function () {
    return view('puntos');
})->name("puntos");
