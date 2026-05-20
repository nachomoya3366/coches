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
        Schema::create('coches', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('matricula')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('color');
            $table->integer('año');
            $table->integer('kilometros');
            $table->enum('combustible', ['diesel', 'gasolina']);
            $table->foreignId('proveedore_id')->constrained('proveedores')->onDelete('cascade');
            $table->integer('precio_compra');
            $table->enum('estado', ['stock', 'vendido'])->default('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coches');
    }
};
