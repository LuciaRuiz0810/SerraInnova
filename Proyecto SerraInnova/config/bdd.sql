-- Base de Datos para Sistema Inmobiliario
-- Creación de base de datos
CREATE DATABASE IF NOT EXISTS inmobiliaria;
USE inmobiliaria;

-- Tabla de Usuarios (sistema de autenticación)
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('cliente', 'agente', 'administrador') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT TRUE
);

-- Tabla de Clientes
CREATE TABLE clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    dni VARCHAR(20) UNIQUE,
    direccion VARCHAR(200),
    fecha_nacimiento DATE,
    preferencias TEXT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de Agentes
CREATE TABLE agentes (
    id_agente INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    dni VARCHAR(20) UNIQUE,
    licencia VARCHAR(50),
    zona_trabajo VARCHAR(100),
    comision_porcentaje DECIMAL(5,2) DEFAULT 3.00,
    ventas_totales INT DEFAULT 0,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

-- Tabla de Propiedades
CREATE TABLE propiedades (
    id_propiedad INT PRIMARY KEY AUTO_INCREMENT,
    id_agente INT,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    tipo_propiedad ENUM('casa', 'apartamento', 'local', 'terreno', 'oficina') NOT NULL,
    tipo_operacion ENUM('venta', 'alquiler', 'ambos') NOT NULL,
    precio_venta DECIMAL(12,2),
    precio_alquiler DECIMAL(10,2),
    direccion VARCHAR(200) NOT NULL,
    ciudad VARCHAR(100) NOT NULL,
    provincia VARCHAR(100),
    codigo_postal VARCHAR(10),
    metros_cuadrados DECIMAL(8,2),
    habitaciones INT,
    banos INT,
    garaje BOOLEAN DEFAULT FALSE,
    jardin BOOLEAN DEFAULT FALSE,
    piscina BOOLEAN DEFAULT FALSE,
    ascensor BOOLEAN DEFAULT FALSE,
    amueblado BOOLEAN DEFAULT FALSE,
    estado ENUM('disponible', 'reservado', 'vendido', 'alquilado') DEFAULT 'disponible',
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fotos TEXT,
    FOREIGN KEY (id_agente) REFERENCES agentes(id_agente) ON DELETE SET NULL
);

-- Tabla de Contratos
CREATE TABLE contratos (
    id_contrato INT PRIMARY KEY AUTO_INCREMENT,
    id_propiedad INT NOT NULL,
    id_cliente INT NOT NULL,
    id_agente INT,
    tipo_contrato ENUM('venta', 'alquiler') NOT NULL,
    fecha_firma DATE NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    precio_total DECIMAL(12,2) NOT NULL,
    forma_pago ENUM('contado', 'financiado', 'mensual') DEFAULT 'contado',
    deposito DECIMAL(10,2),
    clausulas TEXT,
    documento_pdf VARCHAR(255),
    estado ENUM('borrador', 'firmado', 'activo', 'finalizado', 'cancelado') DEFAULT 'borrador',
    notas TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_agente) REFERENCES agentes(id_agente) ON DELETE SET NULL
);


-- Índices para mejorar el rendimiento
CREATE INDEX idx_propiedades_ciudad ON propiedades(ciudad);
CREATE INDEX idx_propiedades_tipo ON propiedades(tipo_propiedad);
CREATE INDEX idx_propiedades_estado ON propiedades(estado);
CREATE INDEX idx_contratos_estado ON contratos(estado);
CREATE INDEX idx_contratos_tipo ON contratos(tipo_contrato);
CREATE INDEX idx_clientes_dni ON clientes(dni);
CREATE INDEX idx_agentes_dni ON agentes(dni);

-- Datos de ejemplo
INSERT INTO usuarios (email, password, tipo_usuario) VALUES
('admin@inmobiliaria.com', 'hash_password_1', 'administrador'),
('agente1@inmobiliaria.com', 'hash_password_2', 'agente'),
('cliente1@email.com', 'hash_password_3', 'cliente');

INSERT INTO agentes (id_usuario, nombre, apellidos, telefono, dni, licencia, zona_trabajo) VALUES
(2, 'María', 'García López', '+34 600111222', '12345678A', 'LIC-001', 'Valencia Centro');

INSERT INTO clientes (id_usuario, nombre, apellidos, telefono, dni, direccion) VALUES
(3, 'Juan', 'Pérez Martínez', '+34 611222333', '87654321B', 'Calle Mayor 10, Valencia');

INSERT INTO propiedades (id_agente, titulo, descripcion, tipo_propiedad, tipo_operacion, precio_alquiler, direccion, ciudad, metros_cuadrados, habitaciones, banos) VALUES
(1, 'Apartamento céntrico', 'Bonito apartamento en el centro de Valencia', 'apartamento', 'alquiler', 850.00, 'Calle Colón 25', 'Valencia', 75.00, 2, 1);

INSERT INTO contratos (id_propiedad, id_cliente, id_agente, tipo_contrato, fecha_firma, fecha_inicio, fecha_fin, precio_total, forma_pago, deposito, estado) VALUES
(1, 1, 1, 'alquiler', '2026-01-15', '2026-02-01', '2027-02-01', 10200.00, 'mensual', 1700.00, 'activo');