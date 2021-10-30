create database exFinal;
use exFinal;

CREATE TABLE usuario
(
	usuario VARCHAR(30) NOT NULL,
	pass VARCHAR(30) NOT NULL,
	niver INT(11) NOT NULL,
	estado BIT
);

CREATE TABLE sucursal
(
	codigoSucursal INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    direccion VARCHAR(75) NOT NULL,
	estado BIT
);

CREATE TABLE area
(
	codigoArea INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    codigoSucursal INT(11) NOT NULL,
    FOREIGN KEY (codigoSucursal) REFERENCES sucursal(codigoSucursal),
	estado BIT
);

CREATE TABLE empleado
(
	codigoEmpleado INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    edad INT(11) NOT NULL,
    sueldoBase DOUBLE NOT NULL,
    codigoArea INT(11) NOT NULL,
    FOREIGN KEY (codigoArea) REFERENCES area(codigoArea),
	estado BIT
);

INSERT INTO usuario VALUES
('admin', 'admin123', 1,1),
('gerente', 'ger123', 2,1),
('analista', 'abc123', 3,1);

INSERT INTO sucursal (nombre, direccion, estado) VALUES
('Sucursal A', 'Edificio A, Calle A',1),
('Sucursal B', 'Edificio B, Calle B',1),
('Sucursal C', 'Edificio C, Calle C',1),
('Sucursal D', 'Edificio D, Calle D',1),
('Sucursal F', 'Edificio E, Calle E',1);

INSERT INTO area (nombre, telefono, codigoSucursal, estado) values
('Cosmeticos', '1234-5678', 1, 1),
('Higiene', '1234-5678', 1, 1),
('Embutidos', '1234-5678', 2, 1),
('Llantas', '1234-5678', 3, 1),
('Electronicos', '1234-5678', 3, 1),
('Linea Blaca', '1234-5678', 4, 1),
('Zapatos', '1234-5678', 5, 1);

INSERT INTO empleado (nombre, edad, sueldoBase, codigoArea, estado) values
('Juan', 25, 350.00, 4, 1),
('Lena', 25, 350.00, 1, 1),
('Lisa', 25, 350.00, 1, 1),
('Nora', 25, 350.00, 2, 1),
('Pedro', 25, 350.00, 5, 1),
('Enrique', 25, 350.00, 5, 1),
('Manolo', 25, 350.00, 6, 1),
('Raul', 25, 350.00, 3, 1),
('Mafalda', 25, 350.00, 3, 1),
('Ricardo', 25, 350.00, 7, 1);


