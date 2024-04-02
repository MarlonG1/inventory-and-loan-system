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
        Schema::create('equipo_licencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained();
            $table->foreignId('licencia_id')->constrained();
            $table->date('fecha_asignacion')->default(now());
            $table->string('estado')->default('Activa');
            $table->string('observaciones')->nullable()->default('Ninguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_licencias');
    }
};
