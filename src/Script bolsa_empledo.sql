
CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(20) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_registro_empresa` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `entrevista` (
  `id_entrevista` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_postulacion` int(11) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `tipo` enum('presencial','virtual','telefonica') DEFAULT NULL,
  `estado` enum('programada','realizada','cancelada') DEFAULT 'programada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `experiencia` (
  `id_experiencia` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `habilidades` (
  `id_habilidad` int(11) NOT NULL,
  `habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `municipios` (
  `id_municipios` int(11) NOT NULL,
  `id_zona` int(11) DEFAULT NULL,
  `municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `notificacion` (
  `id_notificacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime DEFAULT current_timestamp(),
  `leida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `oferta_empleo` (
  `id_oferta` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_salario` int(11) DEFAULT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo_contrato` enum('tiempo_completo','medio_tiempo','temporal','freelance') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `perfil_empresas` (
  `id_perfil_empresa` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(150) DEFAULT NULL,
  `sitio_web` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `perfil_usuarios` (
  `id_perfil` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL, 
  `id_zona_id_municipios` int(11) DEFAULT NULL,
  `id_profesion` int(11) DEFAULT NULL,
  `id_experiencia` int(11) DEFAULT NULL,
  `id_habilidades` int(11) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `genero` enum('M','F','O') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `titulo_permiso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `postulacion` (
  `id_postulacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `fecha_postulacion` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','revisada','aceptada','rechazada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `profesion` (
  `id_profesion` int(11) NOT NULL,
  `profesion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `referencias` (
  `id_referencias` int(11) NOT NULL,
  `id_postulacion` int(11) NOT NULL,
  `nombre_referencia` varchar(100) NOT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `correo_contacto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `rol` enum('admin','usuario','empresa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `salarios` (
  `id_salario` int(11) NOT NULL,
  `rango_salario` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `zonas` (
  `id_zona` int(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `zona` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--modificacion de la db: 14-05-2026--

ALTER TABLE usuarios
DROP COLUMN contraseña ,
ADD COLUMN password varchar(255) NOT NULL;


ALTER TABLE usuarios
MODIFY COLUMN password VARCHAR(255) NOT NULL
AFTER correo;

--modificacion de la db: 16-05-2026--

ALTER TABLE roles
MODIFY COLUMN rol enum('admin','usuario','empresa') DEFAULT 'usuario' NOT NULL;

ALTER TABLE usuarios
ADD COLUMN apellido VARCHAR(100) NOT NULL AFTER nombre;