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
        Schema::create('inventario_prestamo_historico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_historico_id')->constrained();
            $table->unsignedBigInteger('inventario_id');
            $table->string('estado')->nullable();
            $table->string('identificador')->nullable();

            $table->foreign('inventario_id')->references('id')->on('inventario')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_prestamo_historico');
    }
};
