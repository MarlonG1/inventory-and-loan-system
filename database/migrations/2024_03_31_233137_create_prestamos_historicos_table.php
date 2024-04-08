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
        Schema::create('prestamo_historicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id');
            $table->foreignId('user_id');
            $table->string('asignatura');
            $table->string('motivo');
            $table->date('fecha_prestamo');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamo_historicos');
    }
};
