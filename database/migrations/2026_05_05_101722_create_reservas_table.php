<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coche_id')->constrained()->onDelete('cascade');

            $table->date('fecha');
            $table->time('hora');

            $table->string('nombre_cliente')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email');

            $table->timestamps();

            $table->unique(['coche_id', 'fecha', 'hora']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
