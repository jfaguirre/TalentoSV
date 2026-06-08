<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../vendor/autoload.php';

use App\models\Empresa;
use App\helpers\Alert;
use App\models\Ubicacion;

$departamentos = Ubicacion::obtenerDepartamentos();
$distritos = Ubicacion::obtenerDistritos($departamentos[0]['id_departamento'] ?? 0 );
$municipios = Ubicacion::obtenerMunicipios( $distritos[0]['id_distrito'] ?? 0 );


$id_usuario = $_SESSION['userAuth']['id'] ?? null;
if (!$id_usuario) {
    header("Location: index.php?pagina=ingreso");
    exit;
}

// Si ya tiene empresa, solo registra una
$empresaExistente = Empresa::obtenerPorUsuario($id_usuario);
if ($empresaExistente) {
    // Si ya existe, simplemente redirigir a cambiar a modo empresa
    header("Location: index.php?cambiar_modo=empresa");
    exit;
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre_empresa'] ?? '');
    $correo = trim($_POST['correo_empresa'] ?? '');
    $telefono = trim($_POST['telefono_empresa'] ?? '');
    $sector = trim($_POST['sector'] ?? '');
    $id_departamento = isset($_POST['id_departamento']) && $_POST['id_departamento'] !== '' ? (int)$_POST['id_departamento'] : null;
    $id_distrito = isset($_POST['id_distrito']) && $_POST['id_distrito'] !== '' ? (int)$_POST['id_distrito'] : null;
    $id_municipio = isset($_POST['id_municipio']) && $_POST['id_municipio'] !== '' ? (int)$_POST['id_municipio'] : null;
    $sitio_web = trim($_POST['sitio_web'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Validaciones básicas
    if (empty($nombre)) {
        $errores['nombre'] = 'El nombre de la empresa es requerido.';
    }
    if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = 'Debe ingresar un correo electrónico de contacto válido.';
    }

    if (empty($errores)) {
        // 1. Crear empresa base y perfil vacío
        $empresa_id = Empresa::crearEmpresaConPerfil($id_usuario, $nombre, $correo);
        
        if ($empresa_id) {
            // 2. Actualizar el perfil detallado de la empresa
            $resPerfil = Empresa::actualizarPerfilEmpresa(
                $empresa_id,
                $nombre,
                $correo,
                $telefono,
                $sector,
                $id_departamento,
                $id_distrito,
                $id_municipio,
                $sitio_web,
                $descripcion
            );

            if ($resPerfil) {
                // 3. Modificar sesión para cambiar directamente a modo empresa
                $_SESSION['userAuth']['modo'] = 'empresa';
                $_SESSION['userAuth']['empresa_id'] = $empresa_id;

                Alert::success('¡Registro Exitoso!', 'Tu empresa ha sido registrada correctamente. Ahora estás en Modo Empresa.');
                
                echo '
                    <script>
                        setTimeout(function(){
                            window.location.href = "index.php?pagina=inicio";
                        }, 2000);
                    </script>
                ';
            } else {
                $errores['db'] = 'Empresa creada, pero ocurrió un problema al guardar los datos del perfil detallado.';
            }
        } else {
            $errores['db'] = 'Ocurrió un problema de base de datos al registrar la empresa.';
        }
    }
}
?>

<div style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
    <!-- Encabezado de Página -->
    <div style="margin-bottom: 2.5rem; text-align: center;">
        <h1 style="font-size: 2.25rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem;">
            Registrar mi Empresa
        </h1>
        <p style="color: #64748b; font-size: 1.05rem; max-width: 600px; margin: 0 auto; line-height: 1.6;">
            Únete a TalentoES como reclutador. Publica ofertas de empleo, gestiona vacantes y encuentra el mejor talento salvadoreño en tiempo récord.
        </p>
    </div>

    <!-- Alertas de Error -->
    <?php if (!empty($errores)): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.95rem;">
            <strong style="display: block; margin-bottom: 0.25rem;">Por favor, corrige los siguientes inconvenientes:</strong>
            <ul style="margin: 0; padding-left: 1.25rem; line-height: 1.5;">
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02); padding: 2rem;">
        <form action="" method="POST" id="form-registrar-empresa" style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- Grid de Información Básica -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; @media (min-width: 768px) { grid-template-columns: 1fr 1fr; }">
                
                <!-- Nombre de Empresa -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="nombre_empresa" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Nombre de la Empresa <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" id="nombre_empresa" name="nombre_empresa" required 
                           placeholder="Ej. Tech Solutions S.A. de C.V." 
                           value="<?= htmlspecialchars($_POST['nombre_empresa'] ?? ''); ?>"
                           style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <!-- Correo Corporativo -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="correo_empresa" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Correo de Contacto <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="email" id="correo_empresa" name="correo_empresa" required 
                           placeholder="Ej. contrataciones@techsolutions.com" 
                           value="<?= htmlspecialchars($_POST['correo_empresa'] ?? $_SESSION['userAuth']['correo'] ?? ''); ?>"
                           style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <!-- Teléfono Corporativo -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="telefono_empresa" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Teléfono de Contacto
                    </label>
                    <input type="tel" id="telefono_empresa" name="telefono_empresa" 
                           placeholder="Ej. 2222-2222" 
                           value="<?= htmlspecialchars($_POST['telefono_empresa'] ?? ''); ?>"
                           style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <!-- Sector -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="sector" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Sector de Negocio
                    </label>
                    <input type="text" id="sector" name="sector" 
                           placeholder="Ej. Tecnología, Finanzas, Comercio" 
                           value="<?= htmlspecialchars($_POST['sector'] ?? ''); ?>"
                           style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

                <!-- Departamento -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="departamento" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Departamento
                    </label>
                    <select id="departamento" name="id_departamento"
                            style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s; background-color: #fff;"
                            onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                        <option value="">Seleccione un departamento</option>
                    </select>
                </div>

                <!-- Distrito -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="distrito" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Distrito
                    </label>
                    <select id="distrito" name="id_distrito" disabled
                            style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s; background-color: #fff;"
                            onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                        <option value="">Seleccione un distrito</option>
                    </select>
                </div>

                <!-- Municipio -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="municipio" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Municipio
                    </label>
                    <select id="municipio" name="id_municipio" disabled
                            style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s; background-color: #fff;"
                            onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                        <option value="">Seleccione un municipio</option>
                    </select>
                </div>

                <!-- Sitio Web -->
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label for="sitio_web" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                        Sitio Web Oficial
                    </label>
                    <input type="url" id="sitio_web" name="sitio_web" 
                           placeholder="Ej. https://www.techsolutions.com" 
                           value="<?= htmlspecialchars($_POST['sitio_web'] ?? ''); ?>"
                           style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'">
                </div>

            </div>

            <!-- Descripción de la Empresa (Largo completo) -->
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <label for="descripcion" style="font-size: 0.875rem; font-weight: 600; color: #475569; margin: 0;">
                    Descripción de la Empresa
                </label>
                <textarea id="descripcion" name="descripcion" rows="4" 
                          placeholder="Describe brevemente a tu empresa, su misión, cultura laboral y qué tipo de talentos buscas..."
                          style="padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; outline: none; transition: border-color 0.2s; resize: vertical;"
                          onfocus="this.style.borderColor='#4f46e5'" onblur="this.style.borderColor='#cbd5e1'"><?= htmlspecialchars($_POST['descripcion'] ?? ''); ?></textarea>
            </div>

            <!-- Acciones -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
                <a href="index.php?pagina=inicio" 
                   style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; font-size: 0.95rem; font-weight: 600; color: #64748b; background: transparent; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; transition: all 0.2s;"
                   onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                    Cancelar
                </a>
                <button type="submit" 
                        style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.75rem 1.75rem; font-size: 0.95rem; font-weight: 700; color: #ffffff; background: #10b981; border: none; border-radius: 8px; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2); transition: all 0.2s;"
                        onmouseover="this.style.background='#059669'" onmouseout="this.style.background='#10b981'">
                    <i class="fa-solid fa-circle-check"></i> Registrar Empresa
                </button>
            </div>
            
        </form>
    </div>
</div>

<script>
    // Responsive grid inline style adaptation
    function adjustGrid() {
        const width = window.innerWidth;
        const grid = document.querySelector('#form-registrar-empresa > div');
        if (grid) {
            if (width >= 768) {
                grid.style.gridTemplateColumns = '1fr 1fr';
            } else {
                grid.style.gridTemplateColumns = '1fr';
            }
        }
    }
    window.addEventListener('resize', adjustGrid);
    window.addEventListener('DOMContentLoaded', adjustGrid);


    // Cargar departamentos, distritos y municipios
    document.addEventListener("DOMContentLoaded", () => {
        const departamento = document.getElementById("departamento");
        const distrito = document.getElementById("distrito");
        const municipio = document.getElementById("municipio");

        // Preselección de valores en caso de recarga del formulario
        const selectedDepartamento = <?= json_encode($_POST['id_departamento'] ?? null); ?>;
        const selectedDistrito = <?= json_encode($_POST['id_distrito'] ?? null); ?>;
        const selectedMunicipio = <?= json_encode($_POST['id_municipio'] ?? null); ?>;

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
