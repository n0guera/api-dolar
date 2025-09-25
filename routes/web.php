<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DolarCotizacionController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cotizacion/promedio', [DolarCotizacionController::class, 'promedioMensual']);

