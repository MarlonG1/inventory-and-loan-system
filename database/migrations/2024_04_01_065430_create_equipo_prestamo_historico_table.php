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
        Schema::create('equipo_prestamo_historico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_historico_id')->constrained();
            $table->foreignId('equipo_id')->constrained();
            $table->string('estado')->nullable();
            $table->string('identificador')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_prestamo_historico');
    }
};
