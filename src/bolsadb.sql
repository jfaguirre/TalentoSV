
CREATE DATABASE IF NOT EXISTS bolsadb
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE bolsadb;

-- CATALOGOS

CREATE TABLE roles (
    id_rol INT(11) NOT NULL AUTO_INCREMENT,
    rol ENUM('admin','usuario') NOT NULL,
    PRIMARY KEY (id_rol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE departamentos (
    id_departamento INT(11) NOT NULL AUTO_INCREMENT,
    departamento VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_departamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE distritos (
    id_distrito INT(11) NOT NULL AUTO_INCREMENT,
    id_departamento INT(11) DEFAULT NULL,
    distrito VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_distrito),
    CONSTRAINT fk_distritos_departamento
        FOREIGN KEY (id_departamento)
        REFERENCES departamentos(id_departamento)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE municipios (
    id_municipio INT(11) NOT NULL AUTO_INCREMENT,
    id_distrito INT(11) DEFAULT NULL,
    municipio VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_municipio),
    CONSTRAINT fk_municipios_distrito
        FOREIGN KEY (id_distrito)
        REFERENCES distritos(id_distrito)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- USUARIOS

CREATE TABLE usuarios (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    estado ENUM('activo','inactivo') DEFAULT 'activo',
    id_rol INT(11) NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario),
    CONSTRAINT fk_usuarios_roles
        FOREIGN KEY (id_rol)
        REFERENCES roles(id_rol)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE permisos (
    id_permisos INT(11) NOT NULL AUTO_INCREMENT,
    id_rol INT(11) DEFAULT NULL,
    titulo_permiso VARCHAR(100) NOT NULL,
    descripcion TEXT DEFAULT NULL,
    PRIMARY KEY (id_permisos),
    CONSTRAINT fk_permisos_roles
        FOREIGN KEY (id_rol)
        REFERENCES roles(id_rol)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE notificaciones (
    id_notificacion INT(11) NOT NULL AUTO_INCREMENT,
    id_usuario INT(11) DEFAULT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    leida TINYINT(1) DEFAULT 0,
    PRIMARY KEY (id_notificacion),
    CONSTRAINT fk_notificaciones_usuario
        FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE perfil_usuario (
    id_perfil INT(11) NOT NULL AUTO_INCREMENT,
    id_usuario INT(11) DEFAULT NULL,
    id_departamento INT(11) DEFAULT NULL,
    id_distrito INT(11) DEFAULT NULL,
    id_municipio INT(11) DEFAULT NULL,
    nacionalidad VARCHAR(50) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    genero ENUM('M','F','O') DEFAULT NULL,
    PRIMARY KEY (id_perfil),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento) ON DELETE SET NULL,
    FOREIGN KEY (id_distrito) REFERENCES distritos(id_distrito) ON DELETE SET NULL,
    FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- PERFIL PROFESIONAL

CREATE TABLE profesion (
    id_profesion INT(11) NOT NULL AUTO_INCREMENT,
    id_perfil INT(11) NOT NULL,
    profesion VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_profesion),
    FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE habilidades (
    id_habilidad INT(11) NOT NULL AUTO_INCREMENT,
    id_perfil INT(11) NOT NULL,
    habilidad VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_habilidad),
    FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE experiencia (
    id_experiencia INT(11) NOT NULL AUTO_INCREMENT,
    id_perfil INT(11) NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    puesto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE DEFAULT NULL,
    PRIMARY KEY (id_experiencia),
    FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE estudios (
    id_estudio INT(11) NOT NULL AUTO_INCREMENT,
    id_perfil INT(11) NOT NULL,
    nivel_academico VARCHAR(100) NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    institucion VARCHAR(150) NOT NULL,
    fecha_logro DATE DEFAULT NULL,
    estado ENUM('En curso','Finalizado','Suspendido') DEFAULT 'Finalizado',
    descripcion TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_estudio),
    FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE referencias (
    id_referencia INT(11) NOT NULL AUTO_INCREMENT,
    id_perfil INT(11) NOT NULL,
    nombre_referencia VARCHAR(100) NOT NULL,
    telefono_contacto VARCHAR(20) DEFAULT NULL,
    correo_contacto VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id_referencia),
    FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- EMPRESAS

CREATE TABLE empresas (
    id_empresa INT(11) NOT NULL AUTO_INCREMENT,
    id_usuario INT(11) DEFAULT NULL,
    nombre_empresa VARCHAR(150) NOT NULL,
    correo_empresa VARCHAR(100) NOT NULL,
    telefono_empresa VARCHAR(20) DEFAULT NULL,
    estado ENUM('activo','inactivo') DEFAULT 'activo',
    fecha_registro_empresa DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_empresa),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE perfil_empresa (
    id_perfil_empresa INT(11) NOT NULL AUTO_INCREMENT,
    id_empresa INT(11) DEFAULT NULL,
    descripcion TEXT DEFAULT NULL,
    sector VARCHAR(100) DEFAULT NULL,
    id_departamento INT(11) DEFAULT NULL,
    id_distrito INT(11) DEFAULT NULL,
    id_municipio INT(11) DEFAULT NULL,
    sitio_web VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id_perfil_empresa),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa) ON DELETE CASCADE,
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento) ON DELETE SET NULL,
    FOREIGN KEY (id_distrito) REFERENCES distritos(id_distrito) ON DELETE SET NULL,
    FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- EMPLEOS

CREATE TABLE oferta_empleos (
    id_oferta INT(11) NOT NULL AUTO_INCREMENT,
    id_empresa INT(11) DEFAULT NULL,
    id_departamento INT(11) DEFAULT NULL,
    id_distrito INT(11) DEFAULT NULL,
    id_municipio INT(11) DEFAULT NULL,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT NOT NULL,
    tipo_contrato ENUM('Tiempo completo','Medio tiempo','Temporal','Freelance') DEFAULT NULL,
    PRIMARY KEY (id_oferta),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa) ON DELETE CASCADE,
    FOREIGN KEY (id_departamento) REFERENCES departamentos(id_departamento) ON DELETE SET NULL,
    FOREIGN KEY (id_distrito) REFERENCES distritos(id_distrito) ON DELETE SET NULL,
    FOREIGN KEY (id_municipio) REFERENCES municipios(id_municipio) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE postulaciones (
    id_postulacion INT(11) NOT NULL AUTO_INCREMENT,
    id_usuario INT(11) DEFAULT NULL,
    id_oferta INT(11) DEFAULT NULL,
    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente','revisada','aceptada','rechazada') DEFAULT 'pendiente',
    PRIMARY KEY (id_postulacion),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_oferta) REFERENCES oferta_empleos(id_oferta) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE entrevistas (
    id_entrevista INT(11) NOT NULL AUTO_INCREMENT,
    id_empresa INT(11) DEFAULT NULL,
    id_postulacion INT(11) DEFAULT NULL,
    fecha_hora DATETIME NOT NULL,
    tipo ENUM('presencial','virtual','telefonica') DEFAULT NULL,
    estado ENUM('programada','realizada','cancelada') DEFAULT 'programada',
    PRIMARY KEY (id_entrevista),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa) ON DELETE CASCADE,
    FOREIGN KEY (id_postulacion) REFERENCES postulaciones(id_postulacion) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO roles (rol) VALUES ('admin'),('usuario');

CREATE INDEX idx_usuario_correo ON usuarios(correo);
CREATE INDEX idx_oferta_departamento ON oferta_empleos(id_departamento);
CREATE INDEX idx_oferta_distrito ON oferta_empleos(id_distrito);
CREATE INDEX idx_oferta_municipio ON oferta_empleos(id_municipio);


-- Ubicaciones geograficas

-- DEPARTAMENTOS
INSERT INTO `departamentos` (`departamento`) VALUES
('Ahuachapán'),     
('Cabañas'),         
('Chalatenango'),    
('Cuscatlán'),      
('La Libertad'),     
('La Paz'),         
('La Unión'),      
('Morazán'),         
('San Miguel'),      
('San Salvador'),   
('San Vicente'),     
('Santa Ana'),       
('Sonsonate'),       
('Usulután');        

-- DISTRITOS
INSERT INTO `distritos` (`id_departamento`, `distrito`) VALUES
-- Ahuachapán 
(1, 'Ahuachapán Norte'),
(1, 'Ahuachapán Centro'),
(1, 'Ahuachapán Sur'),
-- Cabañas 
(2, 'Cabañas Oeste'),
(2, 'Cabañas Este'),
-- Chalatenango 
(3, 'Chalatenango Norte'),
(3, 'Chalatenango Centro'),
(3, 'Chalatenango Sur'),
-- Cuscatlán 
(4, 'Cojutepeque'),
(4, 'Suchitoto'),
-- La Libertad 
(5, 'La Libertad Norte'),
(5, 'La Libertad Centro'),
(5, 'La Libertad Este'),
(5, 'La Libertad Oeste'),
(5, 'La Libertad Sur'),
(5, 'Nueva San Salvador'),
-- La Paz 
(6, 'La Paz Oeste'),
(6, 'La Paz Centro'),
(6, 'La Paz Este'),
-- La Unión 
(7, 'La Unión Norte'),
(7, 'La Unión Centro'),
(7, 'La Unión Sur'),
-- Morazán 
(8, 'Morazán Norte'),
(8, 'Morazán Centro'),
(8, 'Morazán Sur'),
-- San Miguel 
(9, 'San Miguel Norte'),
(9, 'San Miguel Centro'),
(9, 'San Miguel Oeste'),
-- San Salvador 
(10, 'San Salvador Norte'),
(10, 'San Salvador Oeste'),
(10, 'San Salvador Este'),
(10, 'San Salvador Centro'),
-- San Vicente 
(11, 'San Vicente Norte'),
(11, 'San Vicente Sur'),
-- Santa Ana 
(12, 'Santa Ana Norte'),
(12, 'Santa Ana Centro'),
(12, 'Santa Ana Este'),
-- Sonsonate 
(13, 'Sonsonate Norte'),
(13, 'Sonsonate Centro'),
(13, 'Sonsonate Sur'),
(13, 'Sonsonate Este'),
-- Usulután
(14, 'Usulután Norte'),
(14, 'Usulután Centro'),
(14, 'Usulután Este'),
(14, 'Usulután Oeste');

-- MUNICIPIOS
INSERT INTO `municipios` (`id_distrito`, `municipio`) VALUES
-- Ahuachapán Norte
(1, 'Ahuachapán'),
(1, 'Apaneca'),
(1, 'Atiquizaya'),
(1, 'El Refugio'),
(1, 'San Lorenzo'),
(1, 'Turín'),
-- Ahuachapán Centro
(2, 'Concepción de Ataco'),
(2, 'Guaymango'),
(2, 'Tacuba'),
-- Ahuachapán Sur
(3, 'Jujutla'),
(3, 'San Francisco Menéndez'),
(3, 'San Pedro Puxtla'),

-- Cabañas Oeste
(4, 'Cinquera'),
(4, 'Ilobasco'),
(4, 'Jutiapa'),
(4, 'Tejutepeque'),
-- Cabañas Este
(5, 'Dolores'),
(5, 'Guacotecti'),
(5, 'San Isidro'),
(5, 'Sensuntepeque'),
(5, 'Victoria'),

-- Chalatenango Norte
(6, 'Agua Caliente'),
(6, 'Arcatao'),
(6, 'Azacualpa'),
(6, 'Citalá'),
(6, 'El Carrizal'),
(6, 'La Laguna'),
(6, 'La Palma'),
(6, 'Las Vueltas'),
(6, 'Nombre de Jesús'),
(6, 'Nueva Trinidad'),
(6, 'San Fernando'),
(6, 'San Francisco Lempa'),
(6, 'San Ignacio'),
(6, 'San Luis del Carmen'),
-- Chalatenango Centro
(7, 'Chalatenango'),
(7, 'Comalapa'),
(7, 'Concepción Quezaltepeque'),
(7, 'Dulce Nombre de María'),
(7, 'El Paraíso'),
(7, 'La Reina'),
(7, 'Nueva Concepción'),
(7, 'Ojos de Agua'),
(7, 'Potonico'),
(7, 'San Antonio de la Cruz'),
(7, 'San Antonio Los Ranchos'),
(7, 'San Francisco Morazán'),
(7, 'San José Cancasque'),
(7, 'San Miguel de Mercedes'),
(7, 'San Rafael'),
-- Chalatenango Sur
(8, 'Tejutla'),
(8, 'San Juan Tejutla'),

-- Cojutepeque
(9, 'Cojutepeque'),
(9, 'Monte San Juan'),
(9, 'El Carmen'),
(9, 'El Rosario'),
(9, 'Oratorio de Concepción'),
(9, 'San Cristóbal'),
(9, 'San Pedro Perulapán'),
(9, 'San Rafael Cedros'),
(9, 'Santa Cruz Analquito'),
(9, 'Santa Cruz Michapa'),
(9, 'Suchitoto'),
(9, 'San José Guayabal'),
-- Suchitoto 
(10, 'Suchitoto'),
(10, 'San Bartolomé Perulapía'),

-- La Libertad Norte
(11, 'Quezaltepeque'),
(11, 'San Pablo Tacachico'),
(11, 'San Juan Opico'),
(11, 'Ciudad Arce'),
-- La Libertad Centro 
(12, 'Colón'),
(12, 'Jayaque'),
(12, 'Sacacoyo'),
(12, 'Tepecoyo'),
(12, 'Talnique'),
-- La Libertad Este 
(13, 'Antiguo Cuscatlán'),
(13, 'Huizúcar'),
(13, 'San José Villanueva'),
(13, 'Zaragoza'),
-- La Libertad Oeste
(14, 'Chiltiupán'),
(14, 'Jicalapa'),
(14, 'La Libertad'),
(14, 'Tamanique'),
(14, 'Teotepeque'),
-- La Libertad Sur 
(15, 'San Luis Talpa'),
(15, 'Comasagua'),
-- Nueva San Salvador 
(16, 'Santa Tecla'),
(16, 'Nuevo Cuscatlán'),

-- La Paz Oeste 
(17, 'Cuyultitán'),
(17, 'El Rosario'),
(17, 'Olocuilta'),
(17, 'San Juan Talpa'),
(17, 'San Luis Talpa'),
(17, 'San Pedro Masahuat'),
(17, 'Santa María Ostuma'),
(17, 'Santiago Nonualco'),
-- La Paz Centro 
(18, 'San Juan Nonualco'),
(18, 'San Rafael Obrajuelo'),
(18, 'Santa Lucía'),
(18, 'Zacatecoluca'),
-- La Paz Este 
(19, 'Jerusalén'),
(19, 'Mercedes La Ceiba'),
(19, 'San Antonio Masahuat'),
(19, 'San Emigdio'),
(19, 'San Francisco Chinameca'),
(19, 'San Miguel Tepezontes'),
(19, 'San Pedro Nonualco'),
(19, 'Santa Elena'),

-- La Unión Norte 
(20, 'Concepción de Oriente'),
(20, 'El Sauce'),
(20, 'Lislique'),
(20, 'Nueva Esparta'),
(20, 'Polorós'),
(20, 'Santa Rosa de Lima'),
-- La Unión Centro 
(21, 'Anamorós'),
(21, 'Bolívar'),
(21, 'El Carmen'),
(21, 'Pasaquina'),
(21, 'San José La Fuente'),
(21, 'Yayantique'),
(21, 'Yucuaiquín'),
-- La Unión Sur 
(22, 'Conchagua'),
(22, 'Intipucá'),
(22, 'La Unión'),
(22, 'Meanguera del Golfo'),
(22, 'San Alejo'),

-- Morazán Norte 
(23, 'Arambala'),
(23, 'Cacaopera'),
(23, 'Corinto'),
(23, 'El Rosario'),
(23, 'Gualococti'),
(23, 'Joateca'),
(23, 'Meanguera'),
(23, 'Perquín'),
(23, 'San Fernando'),
(23, 'San Isidro'),
(23, 'Torola'),
-- Morazán Centro 
(24, 'Chilanga'),
(24, 'Delicias de Concepción'),
(24, 'El Divisadero'),
(24, 'Guatajiagua'),
(24, 'Jocoaitique'),
(24, 'Lolotiquillo'),
(24, 'Osicala'),
(24, 'San Carlos'),
(24, 'San Francisco Gotera'),
(24, 'San Simón'),
(24, 'Sensembra'),
(24, 'Sociedad'),
(24, 'Yamabal'),
(24, 'Yoloaiquín'),
-- Morazán Sur 
(25, 'Chapeltique'),
(25, 'San Augusto'),

-- San Miguel Norte 
(26, 'Ciudad Barrios'),
(26, 'Nuevo Edén de San Juan'),
(26, 'San Antonio'),
(26, 'San Luis de la Reina'),
(26, 'Sesori'),
-- San Miguel Centro 
(27, 'Carolina'),
(27, 'Chapeltique'),
(27, 'Chinameca'),
(27, 'Chirilagua'),
(27, 'El Tránsito'),
(27, 'Moncagua'),
(27, 'Nueva Guadalupe'),
(27, 'Quelepa'),
(27, 'San Miguel'),
(27, 'San Rafael Oriente'),
-- San Miguel Oeste
(28, 'Comacarán'),
(28, 'Uluazapa'),

-- San Salvador Norte 
(29, 'Apopa'),
(29, 'Guazapa'),
(29, 'Nejapa'),
-- San Salvador Oeste 
(30, 'Cuscatancingo'),
(30, 'El Paisnal'),
(30, 'Mejicanos'),
(30, 'San Marcos'),
(30, 'San Martín'),
(30, 'Tonacatepeque'),
-- San Salvador Este 
(31, 'Ilopango'),
(31, 'San Salvador'),
(31, 'Soyapango'),
-- San Salvador Centro 
(32, 'Aguilares'),
(32, 'Ayutuxtepeque'),
(32, 'Delgado'),
(32, 'Panchimalco'),
(32, 'Rosario de Mora'),
(32, 'San Salvador'),
(32, 'Santiago Texacuangos'),
(32, 'Santo Tomás'),
(32, 'Santo Tomás'),

-- San Vicente Norte 
(33, 'Apastepeque'),
(33, 'Guadalupe'),
(33, 'San Cayetano Istepeque'),
(33, 'San Esteban Catarina'),
(33, 'San Ildefonso'),
(33, 'San Lorenzo'),
(33, 'San Sebastián'),
(33, 'Santa Clara'),
(33, 'Santo Domingo'),
-- San Vicente Sur 
(34, 'San Vicente'),
(34, 'Tecoluca'),
(34, 'Tepetitán'),
(34, 'Verapaz'),

-- Santa Ana Norte 
(35, 'Metapán'),
(35, 'Santa Rosa Guachipilín'),
(35, 'Texistepeque'),
-- Santa Ana Centro 
(36, 'Candelaria de la Frontera'),
(36, 'Coatepeque'),
(36, 'El Congo'),
(36, 'El Porvenir'),
(36, 'Masahuat'),
(36, 'Santa Ana'),
-- Santa Ana Este 
(37, 'Chalchuapa'),
(37, 'San Antonio Pajonal'),
(37, 'San Sebastián Salitrillo'),
(37, 'Santiago de la Frontera'),

-- Sonsonate Norte 
(38, 'Armenia'),
(38, 'Caluco'),
(38, 'Cuisnahuat'),
(38, 'Izalco'),
(38, 'Nahuizalco'),
(38, 'Nahulingo'),
(38, 'Salcoatitán'),
(38, 'San Antonio del Monte'),
(38, 'San Julián'),
(38, 'Santa Catarina Masahuat'),
(38, 'Santa Isabel Ishuatán'),
(38, 'Santo Domingo de Guzmán'),
(38, 'Sonsonate'),
(38, 'Sonzacate'),
-- Sonsonate Centro 
(39, 'Acajutla'),
-- Sonsonate Sur 
(40, 'Cuisnahuat'),
(40, 'San Pedro Puxtla'),
-- Sonsonate Este 
(41, 'Juayúa'),
(41, 'Apaneca'),

-- Usulután Norte 
(42, 'Alegría'),
(42, 'Berlín'),
(42, 'California'),
(42, 'Jucuapa'),
(42, 'Mercedes Umaña'),
(42, 'Nueva Granada'),
(42, 'San Buenaventura'),
(42, 'Santiago de María'),
(42, 'Tecapán'),
-- Usulután Centro 
(43, 'Concepción Batres'),
(43, 'El Triunfo'),
(43, 'Ereguayquín'),
(43, 'Estanzuelas'),
(43, 'Jiquilisco'),
(43, 'Ozatlán'),
(43, 'Puerto El Triunfo'),
(43, 'San Agustín'),
(43, 'San Dionisio'),
(43, 'Santa Elena'),
(43, 'Usulután'),
-- Usulután Este 
(44, 'Chirilagua'),
(44, 'Jucuarán'),
(44, 'San Francisco Javier'),
-- Usulután Oeste 
(45, 'Colomoncagua'),
(45, 'Santa María');

-- Aqui mas cambios a futuro
