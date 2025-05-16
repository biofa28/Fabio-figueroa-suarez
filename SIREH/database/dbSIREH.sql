CREATE TABLE usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    documento_identidad VARCHAR(20) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'recepcionista') NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    UNIQUE (documento_identidad),
    UNIQUE (email)
);
CREATE TABLE huespedes (
    huesped_id INT AUTO_INCREMENT PRIMARY KEY,
    documento_identidad VARCHAR(20) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (documento_identidad)
);
CREATE TABLE hoteles (
    hotel_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion TEXT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    nit VARCHAR(20) NOT NULL UNIQUE,
    activo TINYINT(1) DEFAULT 1
);
CREATE TABLE habitaciones (
    habitacion_id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    numero VARCHAR(10) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    estado ENUM('disponible', 'ocupada', 'mantenimiento') DEFAULT 'disponible',
    FOREIGN KEY (hotel_id) REFERENCES hoteles(hotel_id),
    UNIQUE (hotel_id, numero)
);
CREATE TABLE reservas (
    reserva_id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_reserva VARCHAR(20) NOT NULL UNIQUE,
    hotel_id INT NOT NULL,
    huesped_id INT NOT NULL,
    fecha_entrada DATE NOT NULL,
    fecha_salida DATE NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (hotel_id) REFERENCES hoteles(hotel_id),
    FOREIGN KEY (huesped_id) REFERENCES huespedes(huesped_id)
);
CREATE TABLE huellas_digitales (
    huella_id INT AUTO_INCREMENT PRIMARY KEY,
    huesped_id INT NOT NULL,
    template_huella TEXT NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (huesped_id) REFERENCES huespedes(huesped_id),
    UNIQUE (huesped_id)
);
INSERT INTO usuarios (documento_identidad, nombre, apellido, email, contrasena_hash, rol)
VALUES ('123456789', 'Fabio', 'Figueroa', 'fabio@example.com', SHA2('admin123', 256), 'administrador');
INSERT INTO hoteles (nombre, direccion, telefono, nit)
VALUES ('Hotel Ejemplo', 'Calle 123, Cartagena', '1234567', '123456789-0');
INSERT INTO habitaciones (hotel_id, numero, tipo, precio)
VALUES 
(1, '101', 'Sencilla', 150000),
(1, '201', 'Doble', 250000),
(1, '301', 'Suite', 400000);
