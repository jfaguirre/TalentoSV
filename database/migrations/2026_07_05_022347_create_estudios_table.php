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
        Schema::create('estudios', function (Blueprint $table) {
            $table->id()->primary();

            $table->timestamps();
        });
    }


    // CREATE TABLE estudios (
    // id_estudio INT(11) NOT NULL AUTO_INCREMENT,
    // id_perfil INT(11) NOT NULL,
    // nivel_academico VARCHAR(100) NOT NULL,
    // titulo VARCHAR(150) NOT NULL,
    // institucion VARCHAR(150) NOT NULL,
    // fecha_logro DATE DEFAULT NULL,
    // estado ENUM('En curso','Finalizado','Suspendido') DEFAULT 'Finalizado',
    // descripcion TEXT DEFAULT NULL,
    // created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    // PRIMARY KEY (id_estudio),
    // FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios');
    }
};
