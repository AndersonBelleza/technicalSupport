CREATE DATABASE proyecto;
USE proyecto;

CREATE TABLE productos (
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stockMin INT NOT NULL,
    stock INT NOT NULL,
    CONSTRAINT uk_nombre_codigo UNIQUE (codigo)
) ENGINE = INNODB;

CREATE TABLE ventas (
    idVenta INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    montoFinal DECIMAL(10, 2) NOT NULL,
    tipoDocumento VARCHAR(50) NOT NULL,
    tipoCliente VARCHAR(50) NOT NULL,
    fechaEmision DATE NOT NULL,
	medioPago VARCHAR(50) NOT NULL
) ENGINE = INNODB;

CREATE TABLE detalleVenta (
    idDetalleVenta INT AUTO_INCREMENT PRIMARY KEY,
    idProducto INT NOT NULL,
    idVenta INT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    igv DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto),
    FOREIGN KEY (idVenta) REFERENCES ventas(idVenta)
) ENGINE = INNODB;

CREATE TABLE kardex (
    idKardex INT AUTO_INCREMENT PRIMARY KEY,
    idVenta INT NOT NULL,
    idProducto INT NOT NULL,
    nombreProducto VARCHAR(50) NOT NULL,
    tipo VARCHAR(30) NOT NULL,
    cantidad INT NOT NULL,
    stockActual INT NOT NULL,
    fechaEmision DATETIME NOT NULL,
    FOREIGN KEY (idVenta) REFERENCES ventas(idVenta),
    FOREIGN KEY (idProducto) REFERENCES productos(idProducto)
) ENGINE = INNODB;

CREATE TABLE usuarios (
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apellidos VARCHAR(70) NOT NULL,
    nombreusuario VARCHAR(25) NOT NULL,
    nombrerol VARCHAR(25) NOT NULL, -- VENDEDOR, ETC
    clave VARCHAR(100) NOT NULL,
    fechacreacion DATE NOT NULL,
    fechabaja DATE NOT NULL,
    estado CHAR(1) NOT NULL,
    CONSTRAINT uk_nombreusuario_user UNIQUE (nombreusuario)
) ENGINE = INNODB;
