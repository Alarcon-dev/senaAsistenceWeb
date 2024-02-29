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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->date('fecha_de_nacimiento');
            $table->string('genero');
            $table->string('email')->unique(); // Asegura que el email sea único
            $table->string('cargo');
            $table->timestamps();

            $table->unique(['tipo_documento', 'numero_documento', 'primer_nombre', 'primer_apellido', 'fecha_de_nacimiento'], 'personas_uk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
