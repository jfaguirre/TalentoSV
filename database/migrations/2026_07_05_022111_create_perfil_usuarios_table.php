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
        Schema::create('perfil_usuarios', function (Blueprint $table) {
            // Datos personales
            $table->id()->primary();
            $table->string('telefono', 20)->nullable();
            $table->string('nacionalidad', 50)->nullable();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro'])->nullable();
            // Multimedia
            $table->string('foto', 255)->nullable();
            $table->string('cv_path', 255)->nullable();
            $table->string('portfolio_url', 255)->nullable();
            // Redes sociales
            $table->string('linkedin', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('x', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('tiktok', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            // Profesional
            $table->string('titulo_profesional', 100)->nullable();
            $table->text('resumen')->nullable();
            $table->boolean('disponible')->default(true);
            $table->enum('modalidad_preferida', ['presencial', 'hibrido', 'remoto'])->nullable();
            // Privacidad
            $table->boolean('perfil_publico')->default(true);
            $table->boolean('mostrar_telefono')->default(false);
            // Ubicación
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_departamento')->nullable()->constrained('departamentos')->onDelete('set null');
            $table->foreignId('id_distrito')->nullable()->constrained('distritos')->onDelete('set null');
            $table->foreignId('id_municipio')->nullable()->constrained('municipios')->onDelete('set null');
            // Relaciones
            $table->foreignId('nivel_academicos_id')->nullable()->constrained('niveles_academicos')->onDelete('set null');
            // Indices
            $table->index(['disponible', 'modalidad_preferida']);
            $table->index('titulo_profesional');
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_usuarios');
    }
};
