<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\controller\EmpresaControlador;

$controlador = new EmpresaControlador();
$empresa_id = $_SESSION['userAuth']['empresa_id'] ?? null;
if (!$empresa_id) {
    echo "<h2>Error: No se encontró la empresa asociada.</h2>";
    exit;
}

$perfil = $controlador->gestionarPerfil($empresa_id);
?>

<div class="page-header">
    <h1 class="page-title">Perfil de Empresa</h1>
    <p class="page-subtitle">Modifica la información de presentación de tu marca empleadora.</p>
</div>

<div class="card">
    <h2 class="card-title">Información General</h2>
    
    <form action="" method="POST">
        <div class="form-grid">
            <!-- Nombre de Empresa -->
            <div class="form-group">
                <label class="form-label" for="nombre_empresa">Nombre de la Empresa <span style="color:var(--danger)">*</span></label>
                <input type="text" class="form-input" id="nombre_empresa" name="nombre_empresa" value="<?= htmlspecialchars($perfil['nombre_empresa'] ?? ''); ?>" required placeholder="Ej. Tech Solutions S.A. de C.V.">
            </div>

            <!-- Sector -->
            <div class="form-group">
                <label class="form-label" for="sector">Sector de Negocio</label>
                <input type="text" class="form-input" id="sector" name="sector" value="<?= htmlspecialchars($perfil['sector'] ?? ''); ?>" placeholder="Ej. Tecnología, Finanzas, Comercio, Educación">
            </div>

            <!-- Correo de Contacto -->
            <div class="form-group">
                <label class="form-label" for="correo_empresa">Correo Electrónico de Contacto <span style="color:var(--danger)">*</span></label>
                <input type="email" class="form-input" id="correo_empresa" name="correo_empresa" value="<?= htmlspecialchars($perfil['correo_empresa'] ?? ''); ?>" required placeholder="Ej. contrataciones@techsolutions.com">
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <label class="form-label" for="telefono_empresa">Teléfono Corporativo</label>
                <input type="tel" class="form-input" id="telefono_empresa" name="telefono_empresa" value="<?= htmlspecialchars($perfil['telefono_empresa'] ?? ''); ?>" placeholder="Ej. 2222-2222">
            </div>

            <!-- Departamento -->
            <div class="form-group">
                <label class="form-label" for="departamento">Departamento</label>
                <select class="form-input" id="departamento" name="id_departamento">
                    <option value="">Seleccione un departamento</option>
                </select>
            </div>

            <!-- Distrito -->
            <div class="form-group">
                <label class="form-label" for="distrito">Distrito</label>
                <select class="form-input" id="distrito" name="id_distrito" disabled>
                    <option value="">Seleccione un distrito</option>
                </select>
            </div>

            <!-- Municipio -->
            <div class="form-group">
                <label class="form-label" for="municipio">Municipio</label>
                <select class="form-input" id="municipio" name="id_municipio" disabled>
                    <option value="">Seleccione un municipio</option>
                </select>
            </div>

            <!-- Sitio Web -->
            <div class="form-group">
                <label class="form-label" for="sitio_web">Sitio Web Oficial</label>
                <input type="url" class="form-input" id="sitio_web" name="sitio_web" value="<?= htmlspecialchars($perfil['sitio_web'] ?? ''); ?>" placeholder="Ej. https://www.techsolutions.com">
            </div>

            <!-- Descripción (Full Width) -->
            <div class="form-group form-grid-full" style="grid-column: span 2;">
                <label class="form-label" for="descripcion">Descripción de la Empresa</label>
                <textarea class="form-input form-textarea" id="descripcion" name="descripcion" placeholder="Describe brevemente a tu empresa, su cultura laboral y qué tipo de talentos buscas..."><?= htmlspecialchars($perfil['descripcion'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-grid-full" style="grid-column: span 2; display: flex; justify-content: flex-end; margin-top: 1rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const departamento = document.getElementById("departamento");
        const distrito = document.getElementById("distrito");
        const municipio = document.getElementById("municipio");

        // Preselección de valores guardados en el perfil de la empresa
        const selectedDepartamento = <?= json_encode($perfil['id_departamento'] ?? null); ?>;
        const selectedDistrito = <?= json_encode($perfil['id_distrito'] ?? null); ?>;
        const selectedMunicipio = <?= json_encode($perfil['id_municipio'] ?? null); ?>;

        // Cargar departamentos
        fetch("index.php?action=get_departamentos")
            .then(res => res.json())
            .then(data => {
                departamento.innerHTML = '<option value="">Seleccione un departamento</option>';
                data.forEach(dep => {
                    departamento.innerHTML += `
                        <option value="${dep.id_departamento}">
                            ${dep.departamento}
                        </option>
                    `;
                });

                if (selectedDepartamento) {
                    departamento.value = selectedDepartamento;
                    cargarDistritos(selectedDepartamento, selectedDistrito);
                }
            })
            .catch(err => console.error("Error al cargar departamentos:", err));

        function cargarDistritos(id_departamento, preselectId = null) {
            distrito.innerHTML = '<option value="">Seleccione un distrito</option>';
            municipio.innerHTML = '<option value="">Seleccione un municipio</option>';
            municipio.disabled = true;

            if (!id_departamento) {
                distrito.disabled = true;
                return;
            }

            fetch(`index.php?action=get_distritos&id_departamento=${id_departamento}`)
                .then(res => res.json())
                .then(data => {
                    distrito.disabled = false;
                    data.forEach(item => {
                        distrito.innerHTML += `
                            <option value="${item.id_distrito}">
                                ${item.distrito}
                            </option>
                        `;
                    });

                    if (preselectId) {
                        distrito.value = preselectId;
                        cargarMunicipios(preselectId, selectedMunicipio);
                    }
                })
                .catch(err => console.error("Error al cargar distritos:", err));
        }

        function cargarMunicipios(id_distrito, preselectId = null) {
            municipio.innerHTML = '<option value="">Seleccione un municipio</option>';

            if (!id_distrito) {
                municipio.disabled = true;
                return;
            }

            fetch(`index.php?action=get_municipios&id_distrito=${id_distrito}`)
                .then(res => res.json())
                .then(data => {
                    municipio.disabled = false;
                    data.forEach(item => {
                        municipio.innerHTML += `
                            <option value="${item.id_municipio}">
                                ${item.municipio}
                            </option>
                        `;
                    });

                    if (preselectId) {
                        municipio.value = preselectId;
                    }
                })
                .catch(err => console.error("Error al cargar municipios:", err));
        }

        departamento.addEventListener("change", () => {
            cargarDistritos(departamento.value);
        });

        distrito.addEventListener("change", () => {
            cargarMunicipios(distrito.value);
        });
    });
</script>
