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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->year('manufacturing_year');
            $table->enum('fuel_type', ['Gasolina', 'Diesel', 'Elétrico', 'Híbrido', 'GNV', 'Flex', 'Etanol', 'Outros']);
            $table->enum('type', ['Carro', 'Motocicleta', 'Caminhão', 'Outro']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
