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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('aula_id')->nullable()->constrained();
            $table->foreignId('carrera_id')->nullable()->constrained();
            $table->foreignId('asignatura_id')->nullable()->constrained();
            $table->text('motivo');
            $table->string('estado')->nullable()->default('Activo');
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
        Schema::dropIfExists('prestamos');
    }
};
