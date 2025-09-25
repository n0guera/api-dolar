<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DolarCotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DolarCotizacionController extends Controller
{
    public function promedioMensual(Request $request)
    {
        $tipo = $request->input('type'); // ej: 'blue', 'oficial'
        $mes = $request->input('month', Carbon::now()->month);
        $anio = $request->input('year', Carbon::now()->year);

        $cotizaciones = DolarCotizacion::where('type', $tipo)
            ->whereMonth('cotizacion_date', $mes)
            ->whereYear('cotizacion_date', $anio)
            ->get();

        if ($cotizaciones->isEmpty()) {
            return response()->json(['message' => 'No hay datos disponibles'], 404);
        }

        $promedioCompra = round($cotizaciones->avg('compra'), 2);
        $promedioVenta = round($cotizaciones->avg('venta'), 2);

        return response()->json([
            'type' => $tipo,
            'month' => $mes,
            'year' => $anio,
            'promedio_compra' => $promedioCompra,
            'promedio_venta' => $promedioVenta,
            'cantidad_registros' => $cotizaciones->count(),
        ]);
    }
}
