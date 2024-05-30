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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->nullable();
            $table->foreignId('departamento_id')->nullable()->constrained('departamentos')->onDelete('no action');
            $table->foreignId('carrera_id')->nullable()->constrained('carreras')->onDelete('no action');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('type')->default('Estudiante');
            $table->string('phone')->nullable();
            $table->string('carnet')->nullable()->unique();
            $table->date('birth_date')->nullable();
            $table->string('image');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
