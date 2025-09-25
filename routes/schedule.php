<?php 
use Illuminate\Console\Scheduling\Schedule;

return function (Schedule $schedule) {
    $schedule->command('app:fetch-dolar-cotizacion')->everyTenMinutes();
};
?>