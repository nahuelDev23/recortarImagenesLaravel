<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recortar;

Route::get('/', function () {
    return view('welcome');
});
Route::POST('subirImagen',[Recortar::class,'subirImagen'])->name('subirImagen.recortar');
