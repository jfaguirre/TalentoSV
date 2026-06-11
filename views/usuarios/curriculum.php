<?php

require_once __DIR__ . '/../../vendor/autoload.php';
?>



<div class="cv-container">

    <h2 class="titulo">Crear Currículum</h2>

    <form method="POST" enctype="multipart/form-data" action="index.php?pagina=cv_guardar">

        <!-- ===========================
             DATOS GENERALES
        ============================ -->
        <div class="card2">
            <h3>Datos Generales</h3>

            <label>Nombre completo</label>
            <input type="text" name="nombre" required>

            <label>Nacionalidad</label>
            <input type="text" name="nacionalidad">

            <label>Teléfono</label>
            <input type="text" name="telefono">

            <label>Género</label>
            <select name="genero">
                <option value="">Seleccione</option>
                <option>Masculino</option>
                <option>Femenino</option>
                <option>Otro</option>
            </select>
        </div>

        <!-- ===========================
             PROFESIÓN
        ============================ -->
        <div class="card2">
            <h3>Profesión</h3>

            <label>Profesión</label>
            <input type="text" name="profesion" required>
        </div>

        <!-- ===========================
             EXPERIENCIA
        ============================ -->
        <div class="card2">
            <h3>Experiencia Laboral</h3>

            <label>Empresa</label>
            <input type="text" name="empresa">

            <label>Puesto</label>
            <input type="text" name="puesto">

            <label>Descripción</label>
            <textarea name="descripcion"></textarea>

            <label>Fecha inicio</label>
            <input type="date" name="fecha_inicio">

            <label>Fecha fin</label>
            <input type="date" name="fecha_fin">
        </div>

        <!-- ===========================
             HABILIDADES
        ============================ -->
        <div class="card2">
            <h3>Habilidades</h3>

            <label>Habilidad principal</label>
            <input type="text" name="habilidad">
        </div>

        <!-- ===========================
             ESTUDIOS (lista)
        ============================ -->
        <div class="card2">
            <h3>Estudios</h3>

            <label>Nivel académico</label>
            <input type="text" name="nivel_academico">

            <label>Carrera</label>
            <input type="text" name="carrera">

            <label>Institución</label>
            <input type="text" name="institucion">

            <label>Fecha inicio</label>
            <input type="date" name="estudio_inicio">

            <label>Fecha fin</label>
            <input type="date" name="estudio_fin">

            <label>Estado</label>
            <select name="estado">
                <option value="">Seleccione</option>
                <option>En curso</option>
                <option>Finalizado</option>
                <option>Incompleto</option>
            </select>

            <label>Descripción</label>
            <textarea name="estudio_descripcion"></textarea>
        </div>

        <!-- ===========================
             REFERENCIAS
        ============================ -->
        <div class="card2">
            <h3>Referencias</h3>

            <label>Nombre</label>
            <input type="text" name="ref_nombre">

            <label>Teléfono</label>
            <input type="text" name="ref_telefono">

            <label>Correo</label>
            <input type="email" name="ref_correo">
        </div>

        <button class="btn">Guardar CV</button>

    </form>

</div>

