<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dolar_cotizacions', function (Blueprint $table) {
            $table->id();
            $table->string('type'); 
            $table->string('nombre')->nullable();
            $table->decimal('compra', 10, 2)->nullable();
            $table->decimal('venta', 10, 2)->nullable();
            $table->date('cotizacion_date'); 
            $table->timestamps();
        
            $table->unique(['type', 'cotizacion_date']); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dolar_cotizacions');
    }
};
