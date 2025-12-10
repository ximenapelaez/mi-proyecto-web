
CREATE DATABASE SpaSystem;

USE SpaSystem;

-- Tabla para almacenar los clientes
CREATE TABLE Clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15),
    contrasena VARCHAR(255) NOT NULL
);

-- Tabla para los servicios o planes del spa
CREATE TABLE Servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla para almacenar las citas agendadas
CREATE TABLE Citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    servicio_id INT NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado ENUM('Pendiente', 'Confirmada', 'Cancelada') DEFAULT 'Pendiente',
    FOREIGN KEY (cliente_id) REFERENCES Clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES Servicios(id) ON DELETE CASCADE
);

-- Tabla para el carrito de compras
CREATE TABLE Carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    servicio_id INT NOT NULL,
    cantidad INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES Clientes(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES Servicios(id) ON DELETE CASCADE
);
