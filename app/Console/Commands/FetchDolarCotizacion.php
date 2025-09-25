<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use App\Models\DolarCotizacion;

class FetchDolarCotizacion extends Command
{
    protected $signature = 'app:fetch-dolar-cotizacion';
    protected $description = 'Consulta la cotización del dólar y la guarda en la base de datos';


    public function handle()
    {
        $url = env('DOLAR_API_URL');
        $response = Http::get($url);

        if (!$response->ok()) {
            $this->error('Error al consultar la API');
            return;
        }

        $cotizaciones = $response->json();

        if (!is_array($cotizaciones)) {
            $this->error('La respuesta de la API no es un array válido');
            return;
        }

        foreach ($cotizaciones as $item) {
            if (!isset($item['casa'], $item['compra'], $item['venta'], $item['fechaActualizacion'])) {
                continue;
            }

            $type = strtolower($item['casa']);
            $nombre = $item['nombre'];
            $compra = floatval($item['compra']);
            $venta = floatval($item['venta']);
            $fecha = Carbon::parse($item['fechaActualizacion'])->toDateString();

            DolarCotizacion::updateOrCreate(
                ['type' => $type, 'cotizacion_date' => $fecha],
                ['nombre' => $nombre, 'compra' => $compra, 'venta' => $venta]
            );
        }

        $this->info('Cotizaciones actualizadas correctamente');
    }

}

